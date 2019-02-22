<?php
require_once "checkmaker.php";
require_once "plaid.php";

$generation_num = 5;
$population_num = 10;
$mutation_probability = 0.1;

$evaluations = [];
$evaluation_sum = 0;
$generation_count = isset($_GET["gc"]) ? $_GET["gc"] + 1 : 1;
$plaid_list = [];

for ($i = 0; $i < 10; $i++) {
  $eva = isset($_GET["plaid$i"]) ? $_GET["plaid$i"] : 0;
  array_push($evaluations, $eva);
  $evaluation_sum += $eva;
}

if ($evaluation_sum == 0 && $generation_count != 1) {
  echo "<div>評価を選択してください</div>";
  exit();
}

if ($generation_count == 1) {
  $is_first = [];
  for ($i = 1; $i <= $generation_num; $i++) {
    $is_first[$i] = true;
  }
  $cm = new Checkmaker($population_num, $mutation_probability);
  $cm->init_population();
  $is_first[$generation_count] = false;
  $_SESSION["is_first"] = $is_first;
  $_SESSION["cm"] = serialize($cm);
} elseif ($generation_count > $generation_num) {
  $cm = unserialize($_SESSION["cm"]);
  $cm->set_evaluations($evaluations);
  $result_individual = $cm->get_best_individual();
  $plaid_id = $result_individual->get_plaid_id();
  $bg_col = $result_individual->get_color(1);
  $col1 = $result_individual->get_color(2);
  $col2 = $result_individual->get_color(3);
  $col3 = $result_individual->get_color(4);
  $result_plaid = new Plaid($plaid_id, $bg_col, $col1, $col2, $col3);
} else {
  $is_first = $_SESSION["is_first"];
  $cm = unserialize($_SESSION["cm"]);
  if ($is_first[$generation_count] == true) {
    $cm->set_evaluations($evaluations);
    $cm->generate_next();
    $is_first[$generation_count] = false;
  }
  var_dump($is_first);
  $_SESSION["is_first"] = $is_first;
  $_SESSION["cm"] = serialize($cm);
}

// echo "<pre>";
// $cm->print_population();
// echo "</pre>";

foreach ($cm->population as $individual) {
  $plaid_id = $individual->get_plaid_id();
  $bg_col = $individual->get_color(1);
  $col1 = $individual->get_color(2);
  $col2 = $individual->get_color(3);
  $col3 = $individual->get_color(4);

  array_push($plaid_list, new Plaid($plaid_id, $bg_col, $col1, $col2, $col3));
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>チェックメーカー(PHP版)</title>
</head>

<body>
    <h1>チェックメーカー(PHP版)</h1>
    <?php if ($generation_count != $generation_num + 1): ?>
    <p>第
        <?= $generation_count ?>世代:残り
        <?= ($generation_num + 1) - $generation_count ?>
    </p>
    <form method="GET" action="./index.php">
        <?php foreach ($plaid_list as $index => $plaid): ?>
        <?php if ($index == 5): ?>
        <br>
        <?php endif; ?>
        <div style="display:inline-block;">
            <img src="data:image/png;base64,<?= base64_encode($plaid->get_plaid_image()->getImageBlob()) ?>">
            <div>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                <label style="display:inline-block;">
                    <input type="radio" value=<?= $i ?> name="plaid
                    <?= $index ?>" />
                    <?= $i ?>
                </label>
                <?php endfor; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <br>
        <input type="hidden" value="<?= $generation_count ?>" name="gc" />
        <button type="submit">次へ</button>
    </form>
    <?php else: ?>
    <p>あなたにおすすめのチェック柄です</p>
    <img src="data:image/png;base64,<?= base64_encode($result_plaid->get_plaid_image()->getImageBlob()) ?>">
    <br>
    <a href="./index.php">もう一度</a>
    <?php endif; ?>
</body>

</html> 