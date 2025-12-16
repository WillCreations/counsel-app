<?php
session_start();
require_once '../config/config.php';
?>

<?php 
include('./inc/header.php'); 
include('./inc/navbar.php'); 
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <?php include('./inc/topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div id="tester" class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?php echo htmlspecialchars($_SESSION['student_name']); ?>'s Progress and Career Plan</h1>
               <a href="student_profile.php">  <button class="btn-primary rounded px-3 py-1">Back</button></a>
            </div>

      <div class='mb-4'><h5>Available Terms:</h5></div>
<div class="row">
    <?php
    $termQuery = "SELECT t.id, t.term_title, t.year, SUM(g.score) AS total_score, COUNT(g.id) AS grade_count FROM term AS t JOIN grades AS g ON g.term_id = t.id WHERE g.student_id = ? GROUP BY t.id, t.term_title, t.year HAVING grade_count > 0 ORDER BY t.year DESC";
    $termStmt = $conn->prepare($termQuery);
    $termStmt->execute([$_SESSION['student_id']]);
    $termRows = $termStmt->fetchALL(PDO::FETCH_ASSOC);
     list($termLabels, $termValues) = array_reduce($termRows, function($carry, $r)  {
        
        $carry[0][] = $r['year'] . '-' . $r['term_title'] ?: 'Unknown';
        $carry[1][] = (int)$r['total_score']/$r['grade_count'];
        return $carry;
    }, [[], []]);  
    
    if(count($termRows) > 0){
        
        foreach($termRows as $term){
    ?>
    
        <div id="term-<?php echo htmlspecialchars($term['id']); ?>" class="term-tablet col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <?php echo htmlspecialchars($term['term_title']) . " " . htmlspecialchars($term['year']); ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo htmlspecialchars($term['grade_count']); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-group fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        echo "<div class='mb-4'><h5>No terms with recorded grades found for this student.</h5></div>";
    }
    
    ?>
</div>


<?php

    if(isset($_SESSION['analyse'])){
        $studentData = $_SESSION['analyse'];
        // print_r("Student Data" . print_r($studentData, true));
        $term  = $studentData[0]['term_title'];
        $year = $studentData[0]['year'];
        
        list($subjectLabels, $subjectValues) = array_reduce($studentData, function($carry, $r) use ($term, $year) {
            $termCheck = $r['term_title'] === $term;
            $yearCheck = $r['year'] === $year;
            // print_r("Term Check: " . ($termCheck ? 'true' : 'false') . ", Year Check: " . ($yearCheck ? 'true' : 'false') . "\n");
        if (!$termCheck || !$yearCheck) return $carry;
        // print_r("hurdle passed");
        $carry[0][] = $r['grade_subject'] ?: 'Unknown';
        $carry[1][] = (int)$r['score'];
        return $carry;
    }, [[], []]);  
    }
?>

<!-- MAP FORMAT WITHOUT FILTER -->
<?php
// $subjectLabels = array_map(function($r){ return $r['grade_subject'] ?: 'Unknown'; }, $studentData);
// $subjectValues = array_map(function($r){  return (int)$r['score']; }, $studentData);
// $candles = [
//     ['x' => '2024-01-01', 'o' => 100, 'h' => 120, 'l' => 90, 'c' => 115],
//     ['x' => '2024-01-02', 'o' => 115, 'h' => 130, 'l' => 110, 'c' => 125],
//     ['x' => '2024-01-03', 'o' => 125, 'h' => 140, 'l' => 120, 'c' => 130],
// ];
?>
            <!-- Content Row -->
            <div class="row">
                <!-- Student Progress Section -->
              
                <div class="col-xl-6 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Student Progress</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="progressChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Career Plan Section -->
                <div class="col-xl-6 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Career Plan</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="careerChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Science/Arts Ratio</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="doughnutChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Subjects</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="subjectsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
               


                
            </div>

            <!-- Content Row -->
            

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <?php 
    include('./inc/script.php'); 
    include('./inc/footer.php'); 
    ?>
</div>
<!-- End of Content Wrapper -->

<!-- Required for candlestick: moment.js + financial chart plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-financial@0.1.0/dist/chartjs-chart-financial.min.js"></script>




<script>

    (function(){
        const term_1 = document.querySelectorAll(".term-tablet");
        console.log({term_1});
        // Chart instances (kept in outer scope so we can update them)
        let LineChart = null;
        let pieChart = null;
        let doughnutChart = null;
        let barChart = null;
    


        // Helper to create or update charts with new labels/values
        function renderCharts(labels, values, labels2, values2) {

             console.log({labels, values});
             console.log({labels2, values2});
            
            // Defensive: make sure canvas exists
            const ctxLine = document.getElementById('progressChart');
            if (!ctxLine || !ctxLine.getContext) return;
            
            // Defensive: make sure canvas exists
            const ctxPie = document.getElementById('careerChart');
            if (!ctxPie || !ctxPie.getContext) return;
            
            // Defensive: make sure canvas exists
            const ctxDough = document.getElementById('doughnutChart');
            if (!ctxDough || !ctxDough.getContext) return;
            // Defensive: make sure canvas exists
            const ctxBar = document.getElementById('subjectsChart');
            if (!ctxBar || !ctxBar.getContext) return;



                const palette = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#aa1cb4ff', '#2386c0ff', '#fd7e14'];
                const bg = labels.map((_, i) => palette[i % palette.length]);
                const hoverBg = bg.map(c => c);

            const commonData = {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: bg,
                    hoverBackgroundColor: hoverBg,
                    hoverBorderColor: 'rgba(234, 236, 244, 1)',
                    borderWidth: 1.5,
                    fill: true,
                    tension: 0.4
                }]
            };

            const options = {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    bodyFontColor: '#858796',
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    caretPadding: 10
                },
                legend: { display: true, position: 'top' },
                scales : {
                    y: {
                    min: 20,
                    max: 100
                    }
                }
            };

            // progress (line)
        
            if (LineChart) {
                LineChart.data = {...commonData, labels: labels2, datasets: [{...commonData.datasets[0], data: values2, label: "Student's Score", pointBackgroundColor: bg, backgroundColor: 'rgba(78, 115, 223, 0.2)',  borderColor: '#1b4532'}]};
                LineChart.data.datasets[0] = {...LineChart.data.datasets[0], label: "Student's Score", pointBackgroundColor: bg, backgroundColor: 'rgba(78, 115, 223, 0.2)', borderColor: '#1b4532'};
                LineChart.options = {...options, scales: { y: { min: 0, max: 100 } } } 
                LineChart.update();
            } else {
                LineChart = new Chart(ctxLine.getContext('2d'), { type: 'line', data: {...commonData, labels: labels2, datasets: [{...commonData.datasets[0], data: values2, label: "Student's Score", pointBackgroundColor: bg, backgroundColor: 'rgba(78, 115, 223, 0.2)',  borderColor: '#1b4532'}]}, options: {...options, scales: { y: { min: 0, max: 100 } } } });
            }

            // pie
            
            if (pieChart) { 
                pieChart.data = commonData; pieChart.options = {...options, scales: { ...options.scales, y: { display: false }, x: {display: false } } }; pieChart.update(); 
            } else { 
                pieChart = new Chart(ctxPie.getContext('2d'), { type: 'pie', data: commonData, options: {...options, scales: { ...options.scales, y: { display: false }, x: {display: false } } } }); 
            }

            // doughnut
            
            if (doughnutChart) { 
                doughnutChart.data = commonData; doughnutChart.update(); 
            } else { 
                doughnutChart = new Chart(ctxDough.getContext('2d'), { type: 'doughnut', data: commonData, options }); 
            }

            // bar
        
            if (barChart) { 
                barChart.data = commonData; barChart.update(); 
            } else { 
                barChart = new Chart(ctxBar.getContext('2d'), { type: 'bar', data: commonData, options: {...options, scales: { y: { beginAtZero: true } } } }); 
            }
        }


        
        // Data injected from PHP (safely default to empty arrays)
        const subjectLabels = <?php echo json_encode(isset($subjectLabels) ? $subjectLabels : [], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;
        const subjectValues = <?php echo json_encode(isset($subjectValues) ? $subjectValues : [], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;
        const termLabels = <?php echo json_encode(isset($termLabels) ? $termLabels : [], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;
        const termValues = <?php echo json_encode(isset($termValues) ? $termValues : [], JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT); ?>;

        // attach click handlers to term tiles
        term_1.forEach(term => {
            term.addEventListener('click', () => {
                const termId = term.id.split('-')[1];
                console.log("Clicked term ID:", termId);
                if (!termId) return;

                // highlight selected term
                document.querySelectorAll('.term-tablet').forEach(t => t.classList.remove('border-primary'));
                term.classList.add('border-primary');

                // fetch grades for this term
                fetch('get_term_grades.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'term_id=' + encodeURIComponent(termId)
                }).then(r => r.json()).then(json => {
                    console.log('Grades for term', termId, json);
                    if (json.success) {
                        renderCharts(json.labels, json.values, termLabels, termValues);
                    } else {
                        // no data or error: clear charts
                        renderCharts([], [], [], []);
                        console.warn('No data for term:', json.message);
                    }
                }).catch(err => {
                    console.error('Error fetching term grades', err);
                });
            });
        });

       
        renderCharts(subjectLabels, subjectValues, termLabels, termValues);
    

        
    })();  

    </script>  


<!-- <script>
        // // Generate a palette (repeat if needed)
        // const palette = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#aa1cb4ff', '#2386c0ff', '#fd7e14'];
        // const backgroundColor = subjectLabels.map((_, i) => palette[i % palette.length]);
        // const hoverBg = backgroundColor.map(c => c);

        // const data = {
        //     labels: subjectLabels,
        //     datasets: [{
        //         data: subjectValues,
        //         backgroundColor: backgroundColor,
        //         hoverBackgroundColor: hoverBg,
        //         hoverBorderColor: 'rgba(234, 236, 244, 1)',
        //         borderWidth: 1.5,
        //         fill:true,
        //         tension: 0.4
        //     }]
        // };

        // const options = {
        //     maintainAspectRatio: false,
        //     tooltips: {
        //         backgroundColor: 'rgba(0, 0, 0, 0.8)',
        //         bodyFontColor: '#858796',
        //         borderColor: '#dddfeb',
        //         borderWidth: 1,
        //         xPadding: 15,
        //         yPadding: 15,
        //         displayColors: true,
        //         caretPadding: 10
        //     },
        //     legend: { display: true, position: 'top' },
            
        //     scales : {
        //     y: {
        //     min: 20,
        //     max: 100
        //     }
        // }
        // };

    
        
        // new Chart(ctxLine, { type: 'line', data: {...data, datasets: [{...data.datasets[0], label: "Student's Score", pointBackgroundColor: backgroundColor, backgroundColor: 'rgba(78, 115, 223, 0.2)',  borderColor: '#1b4532',}]},  options });

       
        
        // new Chart(ctxPie, { type: 'pie', data: data, options: {...options, scales: { ...options.scales, y: { display: false }, x: {display: false } } } });
 
        // const ctxDough = doughnutChart.getContext('2d');
        // new Chart(ctxDough, { type: 'doughnut', data: data, options: options });

        // const ctxBar = barChart.getContext('2d');
        // new Chart(ctxBar, { type: 'bar', data: data, options: options });
        
   
    





























<script>
 // const candleData = <?php json_encode($candles); ?>;

        // // Plugin expects Date objects (or timestamps) for the x axis.
        // const candleDataParsed = Array.isArray(candleData) ? candleData.map(d => ({
        //     x: new Date(d.x),
        //     o: Number(d.o),
        //     h: Number(d.h),
        //     l: Number(d.l),
        //     c: Number(d.c)
        // })) : [];


        // const candlestickChart = document.getElementById('candlestickChart');
        // if (!candlestickChart || !candlestickChart.getContext) return;


        // console.log({candleDataParsed});








        
        // const ctxcandle = candlestickChart.getContext('2d');
        // // Build per-point color arrays (fallback strategy if plugin color not applied)
        // const upColor = '#16a34a';
        // const downColor = '#dc2626';
        // const unchangedColor = '#999999';

        // const borderColors = candleDataParsed.map(p => (p.c >= p.o ? upColor : downColor));
        // const backgroundColors = borderColors.map(c => {
        //     // make a translucent fill for visibility
        //     return c + '33'; // append 0x33 alpha (approx 20%)
        // });


// render candlestick chart using parsed data
        // new Chart(ctxcandle, {
        //     type: 'candlestick',
        //     data: {
        //         datasets: [{
        //             label: 'Price Movement',
        //             data: candleDataParsed,
        //             // plugin-level color (may be ignored by some builds)
        //             color: { up: upColor, down: downColor, unchanged: unchangedColor },
        //             // and per-point colors as a robust fallback
        //             borderColor: borderColors,
        //             backgroundColor: backgroundColors
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         plugins: { legend: { display: true } },
        //         scales: {
        //             xAxes: [{ type: 'time', time: { unit: 'day' }, ticks: { autoSkip: true } }],
        //             yAxes: [{ scaleLabel: { display: true, labelString: 'Value' }, ticks: { beginAtZero: false } }]
        //         }
        //     }
        // });






    document.addEventListener('DOMContentLoaded',   function() { 
    // var ctxprogress = document.getElementById('progressChart').getContext('2d');
    // var progressChart = new Chart(ctxProgress, {
    //     type: 'line',
    //     data: {
    //         labels: ['January', 'February', 'March', 'April', 'May', 'June'],
    //         datasets: [{
    //             label: 'Student Progress',
    //             data: [65, 59, 80, 81, 56, 55],
    //             backgroundColor: 'rgba(78, 115, 223, 0.2)',
    //             borderColor: 'rgba(78, 115, 223, 1)',
    //             borderWidth: 1z
    //         }]
    //     }
    // });

    // var ctxCareer = document.getElementById('careerChart').getContext('2d');
    // var careerChart = new Chart(ctxCareer, {
    //     type: 'pie',
    //     data: {
    //         labels: ['Engineering', 'Law', 'Medicine',  'Business'],
    //         datasets: [{
    //             label: 'Career Plan',
    //             data: [10, 20, 30, 40],
    //             backgroundColor: [
    //                 'rgba(78, 115, 223, 0.2)',
    //                 'rgba(54, 185, 204, 0.2)',
    //                 'rgba(133, 135, 150, 0.2)',
    //                 'rgba(231, 74, 59, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(78, 115, 223, 1)',
    //                 'rgba(54, 185, 204, 1)',
    //                 'rgba(133, 135, 150, 1)',
    //                 'rgba(231, 74, 59, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     }
    // });

//  var ctxSubject = document.getElementById('subjectsChart').getContext('2d');
//     var subjectChart = new Chart(ctxSubject, {
//         type: 'bar',
//         data: {
//             labels: ['English', 'Math', 'Science', 'History', 'Geography', 'Art'],
//             datasets: [{
//                 label: 'Subjects Progress',
//                 data: [65, 59, 80, 81, 56, 55],
//                 backgroundColor: 'rgba(78, 115, 223, 0.2)',
//                 borderColor: 'rgba(78, 115, 223, 1)',
//                 borderWidth: 1
//             }]
//         }
//     });

}) 

const ctxProgress = document.getElementById('Chartbox').getContext('2d');
//     const progressChart = new Chart(ctxProgress, {
//     type: 'line',
//     data: {
//         labels: ['January', 'February', 'March', 'April', 'May', 'June'],
//         datasets: [{
//             label: "Student's Score",
//             data: [65, 59, 80, 81, 56, 55],
//             backgroundColor: 'rgba(78, 115, 223, 0.2)',
//             borderColor: 'rgba(78, 115, 223, 1)',
//             borderWidth: 1
//         }]
//     }
// });
   
</script> -->