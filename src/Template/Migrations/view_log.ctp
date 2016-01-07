<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Retour à la migration'), 'javascript:history.back()', ['escape' => false]) ?> </li>
    </ul>
</nav>

<div class="migrations view large-9 medium-8 columns content">
    <h3>Afficher la trace d'exécution Kitchen</h3>
    <h4 id="running" style="display:none;"><i class="fa fa-spinner fa-lg fa-pulse" style="color:rgb(0, 86, 184);"></i> En cours d'exécution</h4>
    <h4 id="success" style="display:none;"><i class="fa fa-check-circle fa-lg" style="color:green;"></i> Terminé, avec succès</h4>
    <h4 id="errors" style="display:none;"><i class="fa fa-times-circle fa-lg" style="color:red;"></i> Terminé, avec erreur</h4>
    <pre id="data" style="height: 500px; overflow-x: auto; background-color: #1a1a1a; color: #b3b3b3; font-size: smaller; position: relative;"><div id="loading" style="display:flex;justify-content:center;align-items:center;height:475px; font-size: larger;"><i class="fa fa-lg fa-refresh fa-spin"></i> Chargement de la trace existante ...</div></pre>
    <div style="text-align:right;"><?php echo $this->Form->input('autoscroll', array('type' => 'checkbox', 'label' => 'Défiler automatiquement', 'checked'=>'checked')); ?></div>
</div>


<?php $this->start('script'); ?>
<script type="text/javascript">

    var autoscroll = true;
    var refreshLogIntervalId;
    var loadingText = '<div id="loading" style="display:flex;justify-content:center;align-items:center;height:475px; font-size: larger;"><i class="fa fa-lg fa-refresh fa-spin"></i> Chargement de la trace existante ...</div>';

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
                if(div.innerHTML === loadingText){
                    div.innerHTML = "";
                    div.innerHTML =  xhr.responseText;
                }else{
                    div.innerHTML = div.innerHTML + xhr.responseText;
                }

                if(autoscroll){
                    div.scrollTop = div.scrollHeight;
                }

                var errors = document.getElementsByClassName('red').length;
                var finished = document.getElementsByClassName('done').length;

                if(finished){
                    clearInterval(refreshLogIntervalId);
                    if(errors){
                        document.getElementById("running").style.display = "none";
                        document.getElementById("errors").style.display = "block";
                    }else{
                        document.getElementById("running").style.display = "none";
                        document.getElementById("success").style.display = "block";
                    }
                }else{
                    document.getElementById("running").style.display = "block";
                }
            }
        };

        var nocache = new Date().getTime();
        var url = "<?php echo $this->Url->build(['controller' => 'Migrations', 'action' => 'getPieceOfLog', '4', '1']);?>"+"?cache="+nocache;

        xhr.open("GET", url, true);
        xhr.send(null);
    }

    document.addEventListener("DOMContentLoaded", function(event) {

        document.getElementById("autoscroll").addEventListener("click", function(){
            autoscroll = !autoscroll;
        });

        getLog();
        refreshLogIntervalId = window.setInterval(getLog,1000);
    });
</script>
<?php $this->end(); ?>