<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Retour à la migration'), 'javascript:history.back()', ['escape' => false]) ?> </li>
    </ul>
</nav>

<div class="migrations view large-9 medium-8 columns content">
    <h3>Afficher le journal d'exécution Kitchen</h3>
    <h4><i class="fa fa-spinner fa-lg fa-pulse" style="color:rgb(0, 86, 184);"></i> En cours d'exécution</h4>
    <h4><i class="fa fa-check-circle fa-lg" style="color:green;"></i> Terminé, avec succès</h4>
    <h4><i class="fa fa-times-circle fa-lg" style="color:red;"></i> Terminé, avec erreur</h4>
    <pre id="data" style="max-height: 500px; overflow-x: auto; background-color: #1a1a1a; color: #b3b3b3; font-size: smaller;">Chargement du journal ...</pre>
    <div style="text-align:right;"><?php echo $this->Form->input('autoscroll', array('type' => 'checkbox', 'label' => 'Défiler automatiquement', 'checked'=>'checked')); ?></div>
</div>


<?php $this->start('script'); ?>
<script type="text/javascript">

    var autoscroll = true;

    function getXMLHttpRequest() {
        var xhr = null;

        if (window.XMLHttpRequest || window.ActiveXObject) {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch(e) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                xhr = new XMLHttpRequest();
            }
        } else {
            alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
            return null;
        }

        return xhr;
    }

    function getLog(){
        var xhr = getXMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                var div = document.getElementById('data');
                if(div.innerHTML === 'Chargement du journal ...'){
                    div.innerHTML =  xhr.responseText;
                }else{
                    div.innerHTML = div.innerHTML + xhr.responseText;
                }

                //highlightLog(div.innerHTML);

                if(autoscroll){
                    div.scrollTop = div.scrollHeight;
                }
            }
        };

        xhr.open("GET", "<?php echo $this->Url->build(['controller' => 'Migrations', 'action' => 'getPieceOfLog', '4', '1']);?>", true);
        xhr.send(null);
    }

    function highlightLog() {
        function blue(match) {
            return '<span style="color:blue;">' + match + '</span>';
        }
        function red(match) {
            return '<span style="color:red;">' + match + '</span>';
        }
        document.getElementById('data').innerHTML = document.getElementById('data').innerHTML.replace(/\d{4}\/\d{2}\/\d{2} \d{2}:\d{2}:\d{2}/g, blue);
        document.getElementById('data').innerHTML = document.getElementById('data').innerHTML.replace(/.*ERROR.*/g, red);
        document.getElementById('data').innerHTML = document.getElementById('data').innerHTML.replace(/.*Caused by:.*/g, red);
        document.getElementById('data').innerHTML = document.getElementById('data').innerHTML.replace(/.*-   at .*/g, red);
        document.getElementById('data').innerHTML = document.getElementById('data').innerHTML.replace(/.*-  at .*/g, red);
        document.getElementById('data').innerHTML = document.getElementById('data').innerHTML.replace(/.*   \.\.\. .*/g, red);
    }

    document.addEventListener("DOMContentLoaded", function(event) {

        document.getElementById("autoscroll").addEventListener("click", function(){
            autoscroll = !autoscroll;
        });

        getLog();
        window.setInterval(getLog,1000);
    });
</script>
<?php $this->end(); ?>