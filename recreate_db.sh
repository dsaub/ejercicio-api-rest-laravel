#!/usr/bin/zsh
source .alias

sail artisan migrate:fresh
for i in RegionsSeeder RealmsSeeder HeroesSeeder CreaturesSeeder ArtifactsSeeder ArtifactHeroSeeder; do
	sail artisan db:seed $i
done

