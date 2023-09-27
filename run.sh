#!/bin/env bash

npx tailwindcss -o ./static/style/tailwind.css --watch &
php -S 127.0.0.1:8000