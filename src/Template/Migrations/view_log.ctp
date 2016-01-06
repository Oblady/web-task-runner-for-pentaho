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
/* Copyright (c) 2012: Daniel Richman. License: GNU GPL 3 */
/* Additional features: Priyesh Patel                     */

(function () {

    var dataelem = "#data";
    var autoscroll_enabled = true;

    var url = "<?php echo $this->Url->build(['controller' => 'Migrations', 'action' => 'get_log', '4', '1']);?>";
    var fix_rn = true;
    var load = 30 * 1024; /* 30KB */
    var poll = 1000; /* 1s */

    var kill = false;
    var loading = false;
    var pause = false;
    var reverse = false;
    var log_data = "";
    var log_file_size = 0;

    /* :-( https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/parseInt */
    function parseInt2(value) {
        if(!(/^[0-9]+$/.test(value))) throw "Invalid integer " + value;
        var v = Number(value);
        if (isNaN(v))                 throw "Invalid integer " + value;
        return v;
    }

    function get_log() {
        if (kill | loading) return;
        loading = true;

        var range;
        var first_load;
        var must_get_206;
        if (log_file_size === 0) {
            /* Get the last 'load' bytes */
            range = "-" + load.toString();
            first_load = true;
            must_get_206 = false;
        } else {
            /* Get the (log_file_size - 1)th byte, onwards. */
            range = (log_file_size - 1).toString() + "-";
            first_load = false;
            must_get_206 = log_file_size > 1;
        }

        /* The "log_file_size - 1" deliberately reloads the last byte, which we already
         * have. This is to prevent a 416 "Range unsatisfiable" error: a response
         * of length 1 tells us that the file hasn't changed yet. A 416 shows that
         * the file has been trucnated */

        $.ajax(url, {
            dataType: "text",
            cache: false,
            headers: {Range: "bytes=" + range},
            success: function (data, s, xhr) {
                loading = false;

                var content_size;

                if (xhr.status === 206) {
                    var c_r = xhr.getResponseHeader("Content-Range");
                    if (!c_r)
                        throw "Server did not respond with a Content-Range";

                    log_file_size = parseInt2(c_r.split("/")[1]);
                    content_size = parseInt2(xhr.getResponseHeader("Content-Length"));
                } else if (xhr.status === 200) {
                    if (must_get_206)
                        throw "Expected 206 Partial Content";

                    content_size = log_file_size =
                        parseInt2(xhr.getResponseHeader("Content-Length"));
                } else {
                    throw "Unexpected status " + xhr.status;
                }

                if (first_load && data.length > load)
                    throw "Server's response was too long";

                var added = false;

                if (first_load) {
                    /* Clip leading part-line if not the whole file */
                    if (content_size < log_file_size) {
                        var start = data.indexOf("\n");
                        log_data = data.substring(start + 1);
                    } else {
                        log_data = data;
                    }

                    added = true;
                } else {
                    /* Drop the first byte (see above) */
                    log_data += data.substring(1);

                    if (log_data.length > load) {
                        var start = log_data.indexOf("\n", log_data.length - load);
                        log_data = log_data.substring(start + 1);
                    }

                    if (data.length > 1)
                        added = true;
                }

                if (added){
                    show_log(added);
                    if(autoscroll){
                        var objDiv = document.getElementById('data');
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }
                }
                setTimeout(get_log, poll);
            },
            error: function (xhr, s, t) {
                loading = false;

                if (xhr.status === 416 || xhr.status == 404) {
                    /* 416: Requested range not satisfiable: log was truncated. */
                    /* 404: Retry soon, I guess */

                    log_file_size = 0;
                    log_data = "";
                    show_log();

                    setTimeout(get_log, poll);
                } else {
                    throw "Unknown AJAX Error (status " + xhr.status + ")";
                }
            }
        });
    }

    function show_log() {
        var t = log_data;

        if (reverse) {
            var t_a = t.split(/\n/g);
            t_a.reverse();
            if (t_a[0] == "")
                t_a.shift();
            t = t_a.join("\n");
        }

        if (fix_rn)
            t = t.replace(/\n/g, "\r\n");

        $(dataelem).text(t);
    }

    function error(what) {
        kill = true;

        $(dataelem).text("An error occured :-(.\r\n" +
            "Reloading may help; no promises.\r\n" +
            what);

        return false;
    }

    $(document).ready(function () {

        $('#autoscroll').click(function() {
            autoscroll_enabled = !autoscroll_enabled;
        });

        var hash = location.search.replace(/^\?/, "");

        get_log();
    });

})();
</script>
<?php $this->end(); ?>