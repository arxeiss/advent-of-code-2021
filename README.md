# Advent Of Code 2021 in PHP

New nostalgic Advent of Code in PHP! I worked in PHP for many years, so this time I want to remind those days to myself.
To see the original tasks for all days and previous years, visit https://adventofcode.com/. All credits to them for this nice work!

- Year 2019 in Elixir: https://github.com/arxeiss/advent-of-code-2019
- Year 2020 in Go: https://github.com/arxeiss/advent-of-code-2020
- Year 2022 in PHP: https://github.com/arxeiss/advent-of-code-2022

See each day for more information. I copied the instructions there as well.

## How to run

1. Install PHP 8+ and Composer https://getcomposer.org/download/
1. Clone this repo
1. Install dependencies with `php composer install`
1. Run:
    - `php start.php` to execute runner
    - `php vendor/bin/phpunit` to start tests
    - `php vendor/bin/phpcs` to run linter

### Running with Docker

If you don't want to install PHP locally, I suggest to use `./php` bash script which will execute it in PHP docker.
To download Composer locally use this

```bash
wget https://composer.github.io/installer.sig -O - -q | tr -d '\n' > installer.sig
./php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
./php -r "if (hash_file('SHA384', 'composer-setup.php') === file_get_contents('installer.sig')) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
./php composer-setup.php
./php -r "unlink('composer-setup.php'); unlink('installer.sig');"
```

> If you have problem with `./php composer-setup.php` remove from `./php` temporarily the part `--user "$(id -u):$(id -g)"`

Then it remains the same, just use `./php` instead of `php`

### Days I got stuck and searched for the help

- Day 20: I did not realized the endless pane will be changing from zeros to ones and back... The hint from [Kobzol](https://github.com/Kobzol) was required.
- Day 21: I failed with 2 points here. So I went to Reddit for some help and I have found others having same questions.
    - I did not realized, that in Part 2 each player roll dice 3 times. So not creating 3 universes, but 3x3 universes. [Reddit link](https://www.reddit.com/r/adventofcode/comments/rldjpg/2021_day_21_part_2_i_think_im_misunderstanding/)
    - I had no idea how to solve it. So I reached for another topic, where the concept of maximum 44100 combinations was described. [Reddit link](https://www.reddit.com/r/adventofcode/comments/rlairt/2021_day21_part2_can_someone_explain_the_proper/)

## Days

- [Day 1: Sonar Sweep](/src/Day01)
- [Day 2: Dive!](/src/Day02)
- [Day 3: Binary Diagnostic](/src/Day03)
- [Day 4: Giant Squid](/src/Day04)
- [Day 5: Hydrothermal Venture](/src/Day05)
- [Day 6: Lanternfish](/src/Day06)
- [Day 7: The Treachery of Whales](/src/Day07)
- [Day 8: Seven Segment Search](/src/Day08)
- [Day 9: Smoke Basin](/src/Day09)
- [Day 10: Syntax Scoring](/src/Day10)
- [Day 11: Dumbo Octopus](/src/Day11)
- [Day 12: Passage Pathing](/src/Day12)
- [Day 13: Transparent Origami](/src/Day13)
- [Day 14: Extended Polymerization](/src/Day14)
- [Day 15: Chiton](/src/Day15)
- [Day 16: Packet Decoder](/src/Day16)
- [Day 17: Trick Shot](/src/Day17)
- [Day 18: Snailfish](/src/Day18)
- [Day 20: Trench Map](/src/Day20)
- [Day 21: Dirac Dice](/src/Day21)
