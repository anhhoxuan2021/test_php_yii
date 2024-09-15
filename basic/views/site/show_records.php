<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Show Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="row">
        <div class="col-1 fw-bold">ID </div>
        <div class="col-2 fw-bold">Name </div>
        <div class="col-1 fw-bold">ab_mag_h </div>
        <div class="col-2 fw-bold">estimated_diameter </div>
        <div class="col-1 text-center fw-bold">asteroid</div>
        <div class="col-4 fw-bold">close_approach_data</div>
        <div class="col-1 fw-bold">is_sentry_object</div>
    </div>
        <?php
        foreach ($data_arr as $rows){
            ?>
    <div class="row">
        <div class="col-1">
            <?= Html::encode($rows['id']) ?>
        </div>
        <div class="col-2">
            <a href="<?=$rows['nasa_jpl_url']?>">
                <?= Html::encode($rows['name']) ?>
            </a>
        </div>
        <div class="col-1">
            <?= ($rows['absolute_magnitude_h']) ?>
        </div>
        <div class="col-2">
            <div class="row">
                <div class="col-12">
                    <label><i>kilometers</i>:</label>
                    <div class="row">
                        <div class="col">
                            min:  <?= Html::encode($rows['estimated_diameter']['kilometers']['estimated_diameter_min']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            max:  <?= Html::encode($rows['estimated_diameter']['kilometers']['estimated_diameter_max']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label><i>meters</i>:</label>
                    <div class="row">
                        <div class="col">
                            min:  <?= Html::encode($rows['estimated_diameter']['meters']['estimated_diameter_min']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            max:  <?= Html::encode($rows['estimated_diameter']['meters']['estimated_diameter_max']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label><i>miles</i>:</label>
                    <div class="row">
                        <div class="col">
                            min:  <?= Html::encode($rows['estimated_diameter']['miles']['estimated_diameter_min']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            max:  <?= Html::encode($rows['estimated_diameter']['miles']['estimated_diameter_max']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label><i>feet</i>:</label>
                    <div class="row">
                        <div class="col">
                            min:  <?= Html::encode($rows['estimated_diameter']['feet']['estimated_diameter_min']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            max:  <?= Html::encode($rows['estimated_diameter']['feet']['estimated_diameter_max']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1 text-center">
            <div class="row">
                <div class="col text-center">
                    <?= Html::encode($rows['is_potentially_hazardous_asteroid']) ?>
                </div>
            </div>
        </div>

        <div class="col-4">
            <?php
            foreach($rows['close_approach_data'] as $row){
                ?>
                <div class="row">
                    <label class="col-6"><i>close_approach_date: </i></label>
                    <div class="col-4">
                        <?= Html::encode($row['close_approach_date']) ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-6"><i>close_approach_date_full: </i></label>
                    <div class="col-4">
                        <?= Html::encode($row['close_approach_date_full']) ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-6"><i>epoch_date_close_approach: </i></label>
                    <div class="col-4">
                        <?= Html::encode($row['epoch_date_close_approach']) ?>
                    </div>
                </div>
                <div class="row">
                    <label class="col-12 fw-bold">relative_velocity</label>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6"> <i>kilometers_per_second:</i></div>
                            <div class="col"> <?= Html::encode($row['relative_velocity']['kilometers_per_second']) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-6"> <i>kilometers_per_hour:</i></div>
                            <div class="col"> <?= Html::encode($row['relative_velocity']['kilometers_per_hour']) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-6"> <i>miles_per_hour:</i></div>
                            <div class="col"> <?= Html::encode($row['relative_velocity']['miles_per_hour']) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-12 fw-bold">miss_distance</div>
                            <div class="row">
                                <div class="col-6"><i>astronomical:</i></div>
                                <div class="col"> <?= Html::encode($row['miss_distance']['astronomical']) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-6"><i>lunar:</i></div>
                                <div class="col"> <?= Html::encode($row['miss_distance']['lunar']) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-6"><i>kilometers:</i></div>
                                <div class="col"> <?= Html::encode($row['miss_distance']['kilometers']) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-6"><i>miles:</i></div>
                                <div class="col"> <?= Html::encode($row['miss_distance']['miles']) ?></div>
                            </div>
                            <div class="row">
                                <div class="col-6"><i>orbiting_body:</i></div>
                                <div class="col"> <?= Html::encode($row['orbiting_body']) ?></div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="col-1">
            <div class="row">
                <div class="col">
                    <?= Html::encode($rows['is_sentry_object']) ?>
                </div>
            </div>
        </div>

    </div>
        <?php
        }
        ?>



    </p>


</div>
