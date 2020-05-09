<div class="blcInfoPoste">
    <div class="titleInfoPoste">
        <h3 style="background-color: #CFEDEE">Nombre d'installations des logiciels sur les postes :</h3>
        <button id="generatePdf" type="button" class="btn btn-primary">Génerer pdf</button>
    </div>
    <br>
    <canvas id="infoLogInPoste"></canvas><br><br><br>
        <h3 style="background-color: #CFEDEE">Nombre de logiciels installés sur les postes :</h3><br>
    <canvas id="infoLogInPosteNb"></canvas><br><br><br>
        <h3 style="background-color: #CFEDEE">Nombre de postes par salles :</h3><br>
    <canvas id="nbPosteBySalle"></canvas><br><br><br>
</div>


<script>
var ctx = document.getElementById('infoLogInPoste');

var lblLog = [];
var lblLogInstall = [];
var randomColor = [];
<?php foreach ($logicels as $key => $log) { ?>
    lblLog.push('<?= $log['nomLog'] ?>');
    lblLogInstall.push(<?= $log['nbInstall'] ?>);
    randomColor.push(getRandomColor());
<?php } ?>

var myChart = new Chart(ctx, {
    type: 'polarArea',
    data: { 
        labels: lblLog,
        datasets: [{
            label: '',
            data: lblLogInstall,
            backgroundColor: randomColor,
            borderWidth: 1
        }]
    }
});

    var ctx2 = document.getElementById('infoLogInPosteNb');
    var lblLogNb = [];
    var lblLogInstallNb = [];
    var randomColor2 = [];
    <?php foreach ($postes as $keyy => $poste) { ?>
        lblLogNb.push('<?= $poste->nomPoste ?>');
        lblLogInstallNb.push(<?= $poste->nbLog ?>);
        randomColor2.push(getRandomColor());
    <?php } ?>
        console.log(lblLogInstallNb);
        console.log(lblLogNb);
    var myChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: lblLogNb,
        datasets: [{
            label: '',
            data: lblLogInstallNb,
            backgroundColor: randomColor2,
            borderWidth: 1
        }]
    }
});

var ctx3 = document.getElementById('nbPosteBySalle');

var lblSallePostes = [];
var lblSallePostesInstall = [];
var randomColor3 = [];
<?php foreach ($nbPostesSalles as $key => $posteSalle) { ?>
    lblSallePostes.push('<?= $posteSalle['nomSalle'] ?>');
    lblSallePostesInstall.push(<?= $posteSalle['nbPosteSalle'] ?>);
    randomColor3.push(getRandomColor());
<?php } ?>

var myChart3 = new Chart(ctx3, {
    type: 'polarArea',
    data: { 
        labels: lblSallePostes,
        datasets: [{
            label: '',
            data: lblSallePostesInstall,
            backgroundColor: randomColor3,
            borderWidth: 1
        }]
    }
});


function getRandomColor() {
  var l = '0123456789ABCDEF';
  var color = '#';
  for (var i = 0; i < 6; i++) 
    color += l[Math.floor(Math.random() * 16)];
  
  return color;
}

$('#generatePdf').click(function(e){
    var pdf = new jsPDF()

    var canvas = $('#infoLogInPoste');
	var canvasImg = canvas[0].toDataURL("image/png", 1.0);

    var canvas2 = $('#infoLogInPosteNb');
	var canvasImg2 = canvas2[0].toDataURL("image/png", 1.0);
    
    var canvas3 = $('#nbPosteBySalle');
	var canvasImg3 = canvas3[0].toDataURL("image/png", 1.0);

    pdf.setFont("Futura");
    pdf.text('Information PPE-M2L', 80, 20)
    pdf.text('Nombre d\'installations des logiciels sur les postes :', 10, 35)
	pdf.addImage(canvasImg, 'png', 0, 40, 220, 110);
    pdf.text('Nombre de logiciels installer sur les postes :', 10, 160)
	pdf.addImage(canvasImg2, 'png', 0, 165, 210, 110);

    pageHeight= pdf.internal.pageSize.height;
    y = 500 
    if (y >= pageHeight)
    {
    pdf.addPage();
        y = 0 
    }

    pdf.text('Nombre de postes par salles :', 10, 20)
	pdf.addImage(canvasImg3, 'png', 0, 25, 210, 110);
    
    pdf.save('information_postes_M2L.pdf')
});

</script>