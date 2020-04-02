<template>
    <div>
        <div class="Cart">
            <div class="Cart__header">
                <div class="Cart__headerGrid">商品</div>
                <div class="Cart__headerGrid">單價</div>
                <div class="Cart__headerGrid">數量</div>
                <div class="Cart__headerGrid">小計</div>

            </div>
            <div class="Cart__product" v-for="(item,index) in data" :key="index">
                <div class="Cart__productGrid">
                    <img :src="item.attributes" alt="" srcset="" class="img-fluid">
                </div>
                <div class="Cart__productGrid Cart__productTitle">
                    {{ item.name}}
                </div>
                <div class="Cart__productGrid Cart__productPrice">${{ item.price }}</div>
                <div class="Cart__productGrid Cart__productQuantity">{{ item.quantity }}</div>
                <div class="Cart__productGrid Cart__productTotal">{{ item.price * item.quantity}}</div>

            </div>
            <div class="total">
                <hr>
                <div class="text-right">
                    總計:${{ total }}
                </div>
            </div>
        </div>

    </div>
</template>


<script>
export default {
    props: [
        'cartData'
    ],
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            data: JSON.parse(this.cartData)
            // data: this.cartData
        };
    },
    computed: {
        countQuantity: function () {
            var countQuantity = 0;
            for (var i in this.cart) {
                countQuantity += parseInt(this.cart[i].quantity);
            }
            return countQuantity;
        },
        total: function () {
            var total = 0;
            for (var i in this.data) {
                total += parseInt(this.data[i].price * this.data[i].quantity);
            }
            return total;
        },
    },

}
</script>
