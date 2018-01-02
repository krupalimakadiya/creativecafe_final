<?php $base_url = base_url(); ?>
<script type="text/javascript">
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    });
    $.ajaxSetup({
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
            showError("An Unexpected Error has occured. Please try refreshing the page with Ctrl+F5. If Error Persists please contact support with the scenario.");
        }
    });
</script>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2017 creative cafe. All Rights Reserved.</strong>
</footer>
</body>
</html>