<h1>USERPAGE</h1>

<?php
        
        if($content!==''){
            for($i = 0; $i < count($content); $i++){
                $desc = '';
                if($content[$i]['description']!=='') $desc = '<br><span style="color: #cccccc">'.$content[$i]['description'].'</span>';
?>
<div class="data">
    <div style="width: 80%;"><strong><?php echo $content[$i]['service']; ?></strong><?php echo $desc; ?><br><br>R$ <?php echo decimalReal($content[$i]['value']); ?></div>
    <div class="number-input">
        <button onclick="removeItem(this)"></button>
        <input min="0" max="5" name="quantity" value="0" type="number" data-id="<?php echo $content[$i]['id']; ?>" data-price="<?php echo $content[$i]['value']; ?>" >
        <button onclick="addItem(this)" class="plus"></button>
      </div>
</div>
<?php
            }
        }
    ?>




<div class="data">
    <div><strong>TOTAL</strong></div>
    <div>
        <strong>R$ <strong id="total">0,00</strong></strong>
    </div>
</div>
<br>
<button>COMPRAR</button> 
<script>
    let order = new Array ();
    let subtotal = new Array ();
    let total;

    function addItem(e){

        const service = e.parentNode.querySelector('input[type=number]');
        service.stepUp();
        order[service.dataset.id] = service.value;
        subtotal[service.dataset.id] = service.value*service.dataset.price;
        total = 0;
        subtotal.forEach(sumTotal);
console.log(total);
        document.getElementById("total").innerHTML = formatReal(total);


    }
    function removeItem(e){
        const service = e.parentNode.querySelector('input[type=number]');
        service.stepDown();
        
        order[service.dataset.id] = service.value;
        subtotal[service.dataset.id] = service.value*service.dataset.price;
        total = 0;
        subtotal.forEach(deductTotal);
        document.getElementById("total").innerHTML = formatReal(total);


    }

    function sumTotal(item, index){
        total = total + item;
    }

    function deductTotal(item, index){
        total = total - item;
    }

    function formatReal(num) {
        var p = num.toFixed(2).split(".");
        return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
            return  num=="-" ? acc : num + (i && !(i % 3) ? "." : "") + acc;
        }, "") + "," + p[1];
    }
</script>

