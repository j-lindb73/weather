#!/usr/bin/env bash
#
# lefty/weather
#
# Integrate the Weather module onto an existing anax installation.
#

# Copy the configuration files
rsync -av vendor/lefty/weather/config ./

# Copy the source files
rsync -av vendor/lefty/weather/src ./

# Copy the view files
rsync -av vendor/lefty/weather/view ./

# Copy the test files
rsync -av vendor/lefty/weather/test ./

