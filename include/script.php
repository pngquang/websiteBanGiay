<script type="text/javascript">
function addToCart(id, num) {
    $.post('api.php', {
        'action': 'add_to_cart',
        'id': id,
        'num': num
    }, function(data) {
        alert('Thêm vào giỏ thành công!');

    }, )

}
</script>
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/countdown.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
