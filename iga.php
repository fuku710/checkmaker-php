<?php

class Iga
{
  private $poplation = [];        # 集団
  private $poplation_num;         # 集団の個体数
  private $mutation_probability;  # 突然変異確率

  public function __construct(int $population_num, float $mutation_probability)
  {
    if ($population_num < 2 || $mutation_probability > 1.0) {
      throw new UnexpectedValueException();
    }
    $this->population_num = $population_num;
    $this->mutation_probability = $mutation_probability;
  }

  public function get_population()
  {
    return $this->poplation;
  }

  public function set_population(array $population)
  {
    if (count($population) != $this->poplation_num) {
      throw new LengthException();
    }
    foreach ($population as $individual) {
      if ($individual instanceof Individual) {
        throw new UnexpectedValueException();
      }
    }
    $this->population = $population;
  }

  # 初期集団生成
  public function init_population(int $chrom_num)
  {
    $chrom = [];
    for ($i = 0; $i < $chrom_num; $i++) {
      $chrom[$i] = $i == 0 ? rand(0, 7) : rand(0, 255);
    }
    for ($i = 0; $i < $this->poplation_num; $i++) {
      $this->poplation[$i] = new Individual($chrom, 0);
    }
  }

  # 評価値設定
  public function set_evaluations(array $evaluations)
  {
    foreach ($evaluations as $index => $evaluation) {
      $this->poplation[$index]->evaluation;
    }
  }

  # 次世代生成
  public function generate_next_population()
  {
    $evaluation_sum = 0;
    $next_population = [];

    foreach ($this->population as $individual) {
      $evaluation_sum += $individual->evaluation;
    }
    for ($i = 0; $i < $this->population_num; $i++) {
      $parent1 = new Individual();
      $parent2 = new Individual();
      $child = new Individual();
      # ルーレット選択(親1)
      $roulette_target_num = rand(0, $evaluation_sum);
      $roulette_current_num = 0;
      foreach ($this->population as $individual) {
        $roulette_current_num += $individual->evaluation;
        if ($roulette_current_num >= $roulette_target_num) {
          for ($j = 0; $j < 13; $j++) {
            $parent1->chrom[$j] = $individual->chrom[$j];
          }
          break;
        }
      }
      # ルーレット選択(親2)
      $roulette_target_num = rand(0, $evaluation_sum);
      $roulette_current_num = 0;
      foreach ($this->population as $individual) {
        $roulette_current_num += $individual->evaluation;
        if ($roulette_current_num >= $roulette_target_num) {
          for ($j = 0; $j < 13; $j++) {
            $parent2->chrom[$j] = $individual->chrom[$j];
          }
          break;
        }
      }
      # 一様交叉
      for ($j = 0; $j < 13; $j++) {
        $child->chrom[$j] = rand(0, 1) == 0 ? $parent1->chrom[$j] : $parent2->chrom[$j];
      }
      # 突然変異
      for ($j = 0; $j < 13; $j++) {
        if (rand(0, 100) < $this->mutation_probability * 100) {
          $child->chrom[$j] = $j == 0 ? rand(0, 7) : rand(0, 255);
        }
      }
      array_push($next_population, $child);
    }
    $this->population = $next_population;
  }
}
