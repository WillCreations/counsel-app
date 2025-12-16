<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <p class="mt-2"> &copy; PRO TECH <?php echo date("Y"); ?> </p>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Main Content -->

<!-- <script>
    $(document).ready(function(){
    $("#viewProfile").click(function(e){
        e.preventDefault();
        // console.log('pro');
        $.ajax({
            url: 'profile.php',
            type: 'GET',
            dataType: 'json',
            success: function(row){
                var html = '';
                html += '<p><strong>Username:</strong> ' + row.username + '</p>';
                html += '<p><strong>Email:</strong> ' + row.email + '</p>';
                html += '<p><strong>Full Name:</strong> ' + row.full_name + '</p>';
                html += '<p><strong>Full Name:</strong> ' + row.Phone + '</p>';
                
                $("#profileBody").html(html);
                $("#profileModal").modal('show');
            }
        });
    });
});
</script> -->



</body>

</html>