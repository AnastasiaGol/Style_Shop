<?php include ROOT . '/views/layouts/header_admin.php'; ?>
<section>
    <?php // var_dump($categories);die;?>
    <div class="container">
        <div class="row">
            <br/>
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Анализ данных по категориям</li>
                </ol>
            </div>
            <div id="chartdiv"></div>
            <div class="container-fluid"> 
                <div class="row text-center" style="overflow:hidden;">
                    <div class="col-sm-3" style="float: none !important;display: inline-block;">
                        <label class="text-left">Angle:</label>
                        <input class="chart-input" data-property="angle" type="range" min="0" max="60" value="30" step="1"/>	
                    </div>

                    <div class="col-sm-3" style="float: none !important;display: inline-block;">
                        <label class="text-left">Depth:</label>
                        <input class="chart-input" data-property="depth3D" type="range" min="1" max="25" value="10" step="1"/>
                    </div>
                    <div class="col-sm-3" style="float: none !important;display: inline-block;">
                        <label class="text-left">Inner-Radius:</label>
                        <input class="chart-input" data-property="innerRadius" type="range" min="0" max="80" value="0" step="1"/>
                    </div>
                </div>
            </div>



        </div>
    </div>
</section>
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "type": "pie",
        "theme": "light",
        "dataProvider": [
<?php foreach ($categories as $categoryItem): ?>
                {
                    "category": "<?php echo $categoryItem['name']; ?>",
                    "value": "<?php echo $categoryItem['values']; ?>"
                },
<?php endforeach; ?>
        ],
        "valueField": "value",
        "titleField": "category",
        "outlineAlpha": 0.4,
        "depth3D": 15,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "angle": 30,
        "export": {
            "enabled": true
        }
    });
    jQuery('.chart-input').off().on('input change', function () {
        var property = jQuery(this).data('property');
        var target = chart;
        var value = Number(this.value);
        chart.startDuration = 0;
        if (property == 'innerRadius') {
            value += "%";
        }

        target[ property ] = value;
        chart.validateNow();
    });
</script>
<?php include ROOT . '/views/layouts/footer_admin.php'; ?>
