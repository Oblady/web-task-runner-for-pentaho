<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> Retour à la migration'), 'javascript:history.back()', ['escape' => false]) ?> </li>
    </ul>
</nav>

<div class="migrations view large-9 medium-8 columns content">
    <h3><i class="fa fa-check-square"></i> Vérification des prérequis</h3>

    <h5><i class="fa fa-terminal"></i> prérequis système</h5>
    <table>
        <tbody>
            <tr>
                <td id="java">
                    <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; Détection de la machine virtuelle <code>java</code> ...
                </td>
            </tr>
            <tr>
                <td id="pentaho">
                    <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; Détection de <code>kitchen.sh</code> (Pentaho Data Integration) ...
                </td>
            </tr>
            <tr>
                <td id="mysql">
                    <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; Détection de <code>mysql-connector-java-5.1.38-bin.jar</code> (MySQL Connector/J) ...
                </td>
            </tr>
            <tr>
                <td id="logs">
                    <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; Le répertoire <code>logs/kitchen</code> est-il présent et inscriptible ?
                </td>
            </tr>
        </tbody>
    </table>

    <h5><i class="fa fa-cogs"></i> prérequis migration</h5>

    <table>
        <tbody>
        <tr>
            <td id="running">
                <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; Une autre tâche est-elle en cours d'exécution pour cette migration ?
            </td>
        </tr>
        </tbody>
    </table>

    <h5><i class="fa fa-usd"></i> prérequis scénario</h5>

    <table>
        <tbody>
        <tr>
            <td id="scenario-parameters">
                <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; L'ensemble des paramètres liés au scénario sont-ils renseignés ?
            </td>
        </tr>
        </tbody>
    </table>

    <h5><i class="fa fa-list"></i> prérequis tâche</h5>

    <table>
        <tbody>
        <tr>
            <td id="file">
                <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; Le fichier de script PDI <code>.kjb</code> associé à la tâche est-il présent et valide ?
            </td>
        </tr>
        <tr>
            <td id="requirement">
                <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; La tâche spécifié en prérequis de la tâche courante est en succès ?
            </td>
        </tr>
        <tr>
            <td id="file">
                <i class="fa fa-spinner fa-lg fa-pulse"></i> &nbsp; L'ensemble des paramètres liés à la tâche sont-ils renseignés ?
            </td>
        </tr>
        </tbody>
    </table>

</div>

<?php $this->start('script'); ?>
<script type="text/javascript">

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

    function check(action){
        var xhr = getXMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                document.getElementById(action).innerHTML = xhr.responseText;
            }
        };

        var url = "<?php echo $this->Url->build(['controller' => 'Migrations', 'action' => 'check']);?>/"+action;

        xhr.open("GET", url, true);
        xhr.send(null);
    }

    document.addEventListener("DOMContentLoaded", function(event) {
        check('java');
        check('pentaho');
        check('mysql');
        check('logs');
    });
</script>
<?php $this->end(); ?>