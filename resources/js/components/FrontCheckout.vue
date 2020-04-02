<template>
    <div id="app1">
        <div class="container mt-3 mt-sm-5">
            <div class="row justify-content-between mb-3">
                <div class="col-md-9">
                    <h1>全系列產品</h1>
                </div>
                <div class="col-md-3 text-right">
                    <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#cart" @click="cartTotal" style="position: fixed; top: 29%; right: 13%;">
                        <i class="fa fa-shopping-cart"></i>
                        {{ Object.keys(cart).length }}
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3" v-for="(item,index) in selling" :key="index">
                    <div class="card p-3 align-items-center">
                        <img class="card-img-top" :src="item.img" :alt="item.name" width="" style="height:300px; width:150px;" />
                        <div class="card-block text-center">
                            <h4 class="card-title m-2">{{ item.title }}</h4>
                            <div class="card-text m-2">${{ item.price}}</div>
                            <button class="btn btn-primary mt-2" @click="addToCart(index)">加入購物車</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="cart">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">購物車</h5>
                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="/checkout">
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">品名</th>
                                        <th class="text-center">數量</th>
                                        <th class="text-center">單價</th>
                                        <th class="text-center">總價</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in cart" :key="index">
                                        <td>{{item.name}}</td>
                                        <td class="text-center" width="100">
                                            <input class="form-control" type="number" v-model="item.quantity" @change="change(index)" min="1" required>
                                        </td>
                                        <td class="text-center">{{item.price}}</td>
                                        <td class="text-center">${{ item.price *item.quantity}}</td>
                                        <td class="text-center" width="70">
                                            <button class="btn-sm btn-danger" @click="deleltecar(index)" type="button">
                                                <span>刪除</span>
                                            </button>
                                        </td>

                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan='2' class="text-right">數量：{{countQuantity }}</td>
                                        <td colspan='2' class="text-right"><strong>總金額：${{ total }}</strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal">繼續購物</button>
                            <button class="btn btn-primary" disabled id="send">送出訂單</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    created() {
        //獲取產品
        axios
            .post("/admin/liqueurProduct_text")
            .then(response => {
                this.selling = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        axios.get('/totalcart')
            .then(res => {
                this.carts = res.data;
                for (var i in this.carts) {
                    this.cart.push(this.carts[i]);
                }
            }).catch((err) => {
                console.log(err);
            })
    },
    data: function () {
        return {
            cart: [],
            selling: [],
            carts: []
        }
    },
    computed: {
        countQuantity: function () {
            var countQuantity = 0;
            for (var i in this.cart) {
                countQuantity += parseInt(this.cart[i].quantity);
            }

            if (countQuantity < 1) {
                $('#send').attr('disabled', 'disabled');
            } else {
                $('#send').removeAttr('disabled', 'disabled');
            }
            return countQuantity;
        },
        total: function () {
            var total = 0;
            for (var i in this.cart) {
                total += parseInt(this.cart[i].price * this.cart[i].quantity);
            }
            return total;
        },
    },
    methods: {
        addToCart(index) {
            axios.post('/addcart', this.selling[index])
                .then((res) => {
                    for (var i = 0; i < this.cart.length; i++) {
                        if (this.cart[i].id == this.selling[index].id) {
                            this.cart[i].quantity += 1
                            return
                        } else {
                        }
                    }
                    // this.cart.push(this.selling[index])
                    // console.log(this.cart.length);
                    // console.log(res.data);
                    this.cart.push(res.data)
                }).catch((err) => {
                    console.log(err);

                })
        },
        cartTotal() {
            // console.log('aa');
        },
        change(index) {


            let target = this.cart[index]
            console.log(target);

            //總價
            axios.post('/onChange', target)
                .then((res) => {

                }).catch((err) => {
                    console.log(err);

                })
        },
        deleltecar(index) {
            let target = this.cart[index]
            //總價
            axios.post('/deletecar', target)
                .then((res) => {
                    this.cart.splice(index, 1);
                }).catch((err) => {
                    console.log(err);

                })
        }
    }
}
// axios.post('/addcart',this.selling[index])
//             .then((res)=>{
//                 console.log(res);


//             }).catch((err)=>{
//                 console.log(err);

//             })
</script>



