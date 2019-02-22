<?php

class Individual
{
  private $chrom = [];  # 染色体
  private $chrom_num;   # 染色体数
  private $evaluation;  # 評価値

  public function __construct(array $chrom, int $evaluation)
  {
    $this->chrom = $chrom;
    $this->chrom_num = count($chrom);
    $this->evaluation = $evaluation;
  }

  public function get_chrom()
  {
    return $this->chrom;
  }

  public function set_chrom(array $chrom)
  {
    $this->chrom = $chrom;
  }

  public function get_evaluation()
  {
    return $this->evaluation;
  }

  public function set_evaluation(int $evaluation)
  {
    $this->evaluation = $evaluation;
  }
}
