$(document).ready(function(){
    //when + button clicked
    $('.btn-plus').click(function(){
        //toatl countCalculation
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("MMks"," "));
        $qty = $parentNode.find('#qty').val();

        $total = $price * $qty;
        $parentNode.find('#total').html($total+"MMks");

        //total cart summaryCalculation
        summaryCalculation();
    })
    //when - button clicked
    $('.btn-minus').click(function(event){
        //toatl countCalculation
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').text().replace("MMks"," "));
        $qty = $parentNode.find('#qty').val();

        $total = $price * $qty;
        $parentNode.find('#total').html($total+"MMks");

        //total cart summary
        summaryCalculation();
    })
    //when delete button clicked
    $('.btnRemove').click(function() {
        $parentNode = $(this).parents('tr');
        $parentNode.remove();

        //total cart summary
        summaryCalculation();
    })
    //main summary claculation for all
    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tr:not("#header")').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace("MMks"," "));
        })
        $('#subTotalPrice').html($totalPrice+" MMks");
        $('#finalPrice').html($totalPrice+3000 +" MMks");
    }
})
