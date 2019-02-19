<?php
// 個体クラス
class Individual
{
    public $evaluation; // 評価値
    public $chrom = []; // 染色体

    public function __construct()
    {
        $this->evaluation = null;
        $this->chrom = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    }

    // 染色体をランダムで初期化
    public function init_chrom()
    {
        $this->chrom[0] = rand(0, 7);
        for ($i = 1; $i < 13; $i++) {
            $this->chrom[$i] = rand(0, 255);
        }
    }

    // チェック柄の種類を取得
    public function get_plaid_id()
    {
        return $this->chrom[0];
    }

    // 色情報を取得
    public function get_color($color_num)
    {
        return "rgb({$this->chrom[1 * $color_num]},{$this->chrom[2 * $color_num]},{$this->chrom[3 * $color_num]})";
    }
}

// Checkmakerクラス
class Checkmaker
{
    public $population_num; // 個体数
    public $mutation_probability; // 突然変異確率

    public $population = []; // 集団

    public function __construct($population_num, $mutation_probability)
    {
        $this->population_num = $population_num;
        $this->mutation_probability = $mutation_probability;
        for ($i = 0; $i < $this->population_num; $i++) {
            $this->population[$i] = new Individual();
        }
    }

    // 初期集団生成
    public function init_population()
    {
        for ($i = 0; $i < $this->population_num; $i++) {
            $this->population[$i]->init_chrom();
        }
    }

    // 評価値設定
    public function set_evaluations($evaluations)
    {
        for ($i = 0; $i < $this->population_num; $i++) {
            $this->population[$i]->evaluation = $evaluations[$i];
        }
    }

    // 次世代生成
    public function generate_next()
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
            // ルーレット選択(親1)
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
            // ルーレット選択(親2)
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
            // 一様交叉
            for ($j = 0; $j < 13; $j++) {
                $child->chrom[$j] = rand(0, 1) == 0 ? $parent1->chrom[$j] : $parent2->chrom[$j];
            }
            // 突然変異
            for ($j = 0; $j < 13; $j++) {
                if (rand(0, 100) < $this->mutation_probability * 100) {
                    $child->chrom[$j] = $j == 0 ? rand(0, 7) : rand(0, 255);
                }
            }
            array_push($next_population, $child);
        }
        $this->population = $next_population;
    }

    // 最良の個体を取得
    public function get_best_individual()
    {
        $this->sort_population();
        $max_evaluation = $this->population[0]->evaluation;
        $result_population = [];
        foreach ($this->population as $individual) {
            if ($individual->evaluation == $max_evaluation) {
                array_push($result_population, $individual);
            }
        }
        $result_population_num = count($result_population);
        if ($result_population_num > 1) {
            $result_individual = $result_population[rand(0, $result_population_num - 1)];
        } elseif ($result_population_num > 0) {
            $result_individual = $result_population[0];
        }
        return $result_individual;
    }

    // 集団を評価降順にソート
    private function sort_population()
    {
        for ($i = 0; $i < count($this->population) - 1; $i++) {
            for ($j = 0; $j < count($this->population) - 1; $j++) {
                if ($this->population[$j]->evaluation < $this->population[$j + 1]->evaluation) {
                    $tmp = $this->population[$j];
                    $this->population[$j] = $this->population[$j + 1];
                    $this->population[$j + 1] = $this->population[$j];
                }
            }
        }
    }

    public function print_population()
    {
        foreach ($this->population as $index => $individual) {
            echo $index . ":";
            foreach ($individual->chrom as $gene) {
                printf("%3d ", $gene);
            }
            echo "\n";
        }
    }
}

// $checkmaker = new Checkmaker(10, 0.1);
// $checkmaker->init_population();
// $checkmaker->print_population();
// $checkmaker->set_evalations([3, 1, 3, 5, 3, 5, 3, 3, 3, 3]);
// $checkmaker->generate_next();
// $checkmaker->print_population();
// $checkmaker->set_evalations([1, 3, 0, 5, 0, 5, 0, 0, 2, 0]);
