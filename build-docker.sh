#!/usr/bin/env bash

set -e

# Make sure we have the required commands to run this script
if ! command -v jq &>/dev/null; then
    echo "jq is required to run this script"
    exit 1
fi

if ! command -v semver &>/dev/null; then
    echo "semver is required to run this script"
    exit 1
fi

# Read the current version from composer.json
CURRENT_VERSION=$(jq -r ".version" composer.json)

# Read the increment argument (if provided)
INCREMENT=$1

# If $INCREMENT is not empty, run semver to increment the version, then update composer.json and create a git tag
if [ -n "$INCREMENT" ]; then
    VERSION=$(semver --increment "$INCREMENT" "$CURRENT_VERSION")
    jq ".version=\"$VERSION\"" --indent 4 composer.json >composer.json.new
    mv composer.json.new composer.json

    git add composer.json
    git commit -qm "Bump version to $VERSION"
    git tag -a -m "Tagging version $VERSION" "$VERSION"
else
    VERSION=$CURRENT_VERSION
fi

# Build the Docker image
echo "Building Regatta Tracker v$VERSION"
docker buildx build \
       --pull \
       --no-cache \
       --build-arg VERSION="$VERSION" \
       --platform=linux/amd64,linux/arm64/v8 \
       --tag "public.ecr.aws/c3i7i9t1/regatta-tracker:${VERSION}" \
       --tag "public.ecr.aws/c3i7i9t1/regatta-tracker:latest" \
       --push .
