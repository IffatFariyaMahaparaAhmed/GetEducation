
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->
<script src="../assets/js/jquery.js"></script>
<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>


<script src="js/data-table/datatables.min.js"></script>
<script src="js/data-table/dataTables.bootstrap.min.js"></script>
<script src="js/data-table/dataTables.buttons.min.js"></script>
<script src="js/data-table/buttons.bootstrap.min.js"></script>
<script src="js/data-table/jszip.min.js"></script>
<script src="js/data-table/pdfmake.min.js"></script>
<script src="js/data-table/vfs_fonts.js"></script>
<script src="js/data-table/buttons.html5.min.js"></script>
<script src="js/data-table/buttons.print.min.js"></script>
<script src="js/data-table/buttons.colVis.min.js"></script>
<script src="js/data-table/datatables-init.js"></script>
<script src="js/checkeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    } );
</script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="jquery-bar-rating-master/dist/jquery.barrating.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('.rating').barrating({
            theme: 'fontawesome-stars',
            onSelect: function(value, text, event) {

                // Get element id by data-id attribute
                var el = this;
                var el_id = el.$elem.data('id');

                // rating was selected by a user
                if (typeof(event) !== 'undefined') {

                    var split_id = el_id.split("_");

                    var postid = split_id[1];  // postid

                    // AJAX Request
                    $.ajax({
                        url: 'rating_ajax.php',
                        type: 'post',
                        data: {postid:postid,rating:value},
                        dataType: 'json',
                        success: function(data){
                            // Update average
                            var average = data['averageRating'];
                            $('#avgrating_'+postid).text(average);
                        }
                    });
                }
            }
        });
    });

</script>

<script>
    CKEDITOR.replace('application',
        {
            height:300,
            resize_enabled:true,
            wordcount: {
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: true,
                countHTML: false,

                maxCharCount: 20}
        });
</script>