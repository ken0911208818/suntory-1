<template>
    <div>
        <table class="table container">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">訂單編號</th>
                    <th scope="col">收件人姓名</th>
                    <th scope="col">經銷商地點</th>
                    <th scope="col">付款狀態</th>
                    <th scope="col">總額</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{orderfinish.order_no}}</td>
                    <td>{{orderfinish.Recipient_name}}</td>
                    <td>{{orderfinish.dealer_address}}</td>
                    <td>{{orderfinish.payment_status}}</td>
                    <td>{{orderfinish.totalPrice}}</td>
                    <td><button class="btn btn-dark" data-toggle="collapse" data-target="#collapseExample">詳細</button></td>
                </tr>
            </tbody>
        </table>

        <div class="collapse container" id="collapseExample">
            <div class="">
                <div class="Cart">
                    <div class="Cart__header">
                        <div class="Cart__headerGrid">商品</div>
                        <div class="Cart__headerGrid">單價</div>
                        <div class="Cart__headerGrid">數量</div>
                        <div class="Cart__headerGrid">小計</div>

                    </div>
                    <div class="Cart__product" v-for="(item,index) in prodcut" :key="index">

                        <div class="Cart__productGrid">
                            <img :src="item.product[0].img" alt="" srcset="" class="img-fluid">
                        </div>
                        <div class="Cart__productGrid Cart__productTitle">
                            {{item.product[0].title}}
                        </div>
                        <div class="Cart__productGrid Cart__productPrice">${{item.price}}</div>
                        <div class="Cart__productGrid Cart__productQuantity">{{item.qty}}</div>
                        <div class="Cart__productGrid Cart__productTotal">{{item.price*item.qty}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['orderMessage', 'finishOrder'],
    mounted() {
        if (this.message) {
            Swal.fire({
                icon: "success",
                title: this.message,
                timer: 1500
            });
        }
    },
    created() {
        axios
            .post("/admin/productdata", { id: this.orderfinish.id })//訂單詳細
            .then(res => {
                for (var i = 0; i < res.data.length; i++) {
                    this.prodcut.push(res.data[i])
                    console.log(res.data);

                }
            })
            .catch(function (error) {
                console.log(error);
            });

    },
    computed: {
        countQuantity(data) {

            return data;
        },
        total: function () {
            var total = 0;

            return total;
        },
    },
    data() {
        return {
            message: this.orderMessage,
            orderfinish: JSON.parse(this.finishOrder),
            prodcut: [],
        };
    },
    methods: {

    }
};
</script>
