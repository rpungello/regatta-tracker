<?php

namespace App\Console\Commands;

use App\Models\BoatClass;
use App\Models\Event;
use App\Models\EventClass;
use App\Models\Gender;
use App\Models\RaceType;
use App\Models\Regatta;
use App\Models\Team;
use Carbon\Carbon;
use DateTimeInterface;
use DOMDocument;
use DOMElement;
use DOMXPath;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use RuntimeException;

use function Laravel\Prompts\confirm;

class ImportRowtownCommand extends Command
{
    protected $signature = 'import:rowtown {url} {regatta} {team} {--dry-run}';

    protected $description = 'Imports entries from rowtown.org';

    public function handle(): int
    {
        libxml_use_internal_errors(true);
        $regatta = Regatta::findOrFAil($this->argument('regatta'));
        $team = Team::findOrFAil($this->argument('team'));

        if (! confirm("Import $regatta->name entries for $team->name?")) {
            return static::SUCCESS;
        }

        $entries = $this->importEntries($this->argument('url'), $regatta, $team);
        $this->info("Successfully imported {$entries->count()} entries");

        return static::SUCCESS;
    }

    private function importEntries(string $url, Regatta $regatta, Team $team): Collection
    {
        $query = $this->parseQueryString($url);

        if (empty($query['organizationName'])) {
            throw new RuntimeException('Missing organizationName in query string');
        }

        $dom = new DOMDocument;
        $dom->loadHTMLFile($url);
        $x = new DOMXPath($dom);
        $teamDisplayName = $x->query('//select[@name="organizationName"]/option[@selected]')->item(0)->nodeValue;

        $events = $x->query('//table[@id="currentRow"]/tbody/tr');
        $entries = collect();

        /** @var DOMElement $e */
        foreach ($events as $e) {
            $timeNode = $x->query('td[3]', $e)->item(0);
            $eventNode = $x->query('td[4]/a', $e)->item(0);
            $entries = $entries->merge(
                $this->importEvent(
                    $regatta,
                    $this->parseTime($regatta, $timeNode->nodeValue),
                    $eventNode->nodeValue,
                    "http://rowtown.org/results/{$eventNode->getAttribute('href')}",
                    $team,
                    $teamDisplayName
                )
            );
        }

        return $entries;
    }

    private function parseQueryString(string $url): array
    {
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $query);

        return $query;
    }

    private function importEvent(Regatta $regatta, DateTimeInterface $time, string $eventName, string $url, Team $team, string $displayName): Collection
    {
        $this->info("Importing event $eventName");

        $dom = new DOMDocument;
        $dom->loadHTMLFile($url);
        $x = new DOMXPath($dom);

        $event = $this->getEvent($regatta, $eventName, $time);
        $event->entries()->whereTeamId($team->getKey())->delete();

        $entries = $x->query('//table[@id="currentRow"]/tbody/tr');
        $result = collect();
        /** @var DOMElement $e */
        foreach ($entries as $e) {
            $participant = $x->query('td[3]', $e)->item(0)->nodeValue;
            if (str_contains($participant, $displayName)) {
                $bow = $x->query('td[2]', $e)->item(0)->nodeValue;
                $result->push($event->entries()->create([
                    'team_id' => $team->getKey(),
                    'bow_number' => $bow,
                ]));
            }
        }

        return $result;
    }

    private function getEvent(Regatta $regatta, string $eventName, DateTimeInterface $time): Event
    {
        $gender = $this->parseGender($eventName);
        $eventClass = $this->parseEventClass($eventName);
        $boatClass = $this->parseBoatClass($eventName);
        $raceType = $this->parseRaceType($eventName);

        return Event::firstOrCreate([
            'regatta_id' => $regatta->getKey(),
            'gender_id' => $gender->getKey(),
            'event_class_id' => $eventClass->getKey(),
            'boat_class_id' => $boatClass->getKey(),
            'race_type_id' => $raceType->getKey(),
            'time' => $time,
        ], [
            'name' => $eventName,
        ]);
    }

    private function parseGender(string $eventName): Gender
    {
        if (preg_match('/female|women|girl/i', $eventName)) {
            return Gender::whereName('Women')->firstOrFail();
        } elseif (preg_match('/male|men|boy/i', $eventName)) {
            return Gender::whereName('Men')->firstOrFail();
        } elseif (preg_match('/mixed/i', $eventName)) {
            return Gender::whereName('Mixed')->firstOrFail();
        }

        throw new RuntimeException("Unable to parse gender: $eventName");
    }

    private function parseEventClass(string $eventName): EventClass
    {
        if (preg_match('/U(15|16|17)/', $eventName, $matches)) {
            return EventClass::whereName($matches[0])->firstOrFail();
        } elseif (preg_match('/jv|2v/i', $eventName)) {
            return EventClass::whereName('2V')->firstOrFail();
        } elseif (preg_match('/novice|fresh/i', $eventName)) {
            return EventClass::whereName('Novice')->firstOrFail();
        } else {
            return EventClass::whereName('Varsity')->firstOrFail();
        }
    }

    private function parseBoatClass(string $eventName): BoatClass
    {
        if (preg_match('/\d[x+-]+/', $eventName, $matches)) {
            return BoatClass::whereCode($matches[0])->firstOrFail();
        }

        throw new RuntimeException("Unable to parse boat class: $eventName");
    }

    private function parseRaceType(string $eventName): RaceType
    {
        if (preg_match('/trial/i', $eventName)) {
            return RaceType::whereName('Time Trial')->firstOrFail();
        } elseif (preg_match('/flight/i', $eventName)) {
            return RaceType::whereName('Flight')->firstOrFail();
        } elseif (preg_match('/heat/i', $eventName)) {
            return RaceType::whereName('Heat')->firstOrFail();
        } elseif (preg_match('/semi/i', $eventName)) {
            return RaceType::whereName('Semifinal')->firstOrFail();
        } elseif (preg_match('/final/i', $eventName)) {
            return RaceType::whereName('Final')->firstOrFail();
        }

        throw new RuntimeException("Unable to parse race type: $eventName");
    }

    private function parseTime(Regatta $regatta, string $value): DateTimeInterface
    {
        return Carbon::parse($value)->setDate(
            $regatta->date->year,
            $regatta->date->month,
            $regatta->date->day
        );
    }
}
