<template>
    <div class="container">
        <a id="add" href="#create" data-toggle="collapse" class="btn btn-success" @click="clear()">新增</a>

        <hr />

        <div class="collapse" id="create">
            <div class="card card-body">
                <form method="post" action="#" id="form1" @submit.prevent="store(input.index)">
                    <div class="form-group">
                        <div class="col-4">
                            <img :src="input.oldimg" alt srcset class="img-fluid" />
                        </div>
                        <label for="img">地圖</label>
                        <input v-if="this.input.edit == null" type="file" class="form-control" @change="processFile($event)" id="img" name="img" value />
                        <input v-else type="file" class="form-control" @change="processFile($event)" id="img" name="img" value />
                    </div>
                    <div class="form-group">
                        <label for="name">店名</label>
                        <input type="text" class="form-control" v-model="input.name" id="name" name="name" required />
                    </div>
                    <div class="form-group">
                        <label for="tel">電話</label>
                        <input type="text" class="form-control" v-model="input.tel" id="tel" name="tel" required />
                    </div>
                    <div class="form-group">
                        <label for="county">縣市</label>
                        <select required name="county" id="county" v-model="input.county" class="form-control">
                            <option v-for="(item, index) in county_list" :value="item.countyname" :key="index">{{ item.countyname }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input type="text" class="form-control" v-model="input.address" id="address" name="address" required />
                    </div>
                    <div class="form-group" v-if="input.edit != null">
                        <label for="sort">權重</label>
                        <input type="number" class="form-control" v-model="input.sort" id="sort" name="sort" value="0" />
                    </div>

                    <button type="submit" class="btn btn-primary" data-target="#create">
                        儲存
                    </button>
                </form>
            </div>
            <hr />
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>地圖</th>
                    <th>店名</th>
                    <th>電話</th>
                    <th>縣市</th>
                    <th>地址</th>
                    <th>權重</th>
                    <th width="80px"></th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr v-for="(item, index) in shop_data" :key="index">
                    <td>
                        <img :src="item.img" alt srcset class="img-fluid" />
                    </td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.tel }}</td>
                    <td>{{ item.county }}</td>
                    <td>{{ item.address }}</td>
                    <td>{{ item.sort }}</td>
                    <td>
                        <a href="#create" class="btn btn-success btn-sm" data-toggle="collapse" @click="editdata(index)">修改</a>
                        <button class="btn btn-danger btn-sm" @click="deletedata(index)">
                            刪除
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
export default {
    mounted() {
        console.log("Component mounted.");
    },
    props: ["dataShop"],
    created() {
        //獲取經銷商資料
        axios
            .post("/admin/shop_text")
            .then(response => {
                this.shop_data = response.data;
                this.upload();
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    data() {
        return {
            shop_data: JSON.parse(this.dataShop),
            county_list: [
                { countycode: "A", countyname: "臺北市" },
                { countycode: "B", countyname: "臺中市" },
                { countycode: "C", countyname: "基隆市" },
                { countycode: "D", countyname: "臺南市" },
                { countycode: "E", countyname: "高雄市" },
                { countycode: "F", countyname: "新北市" },
                { countycode: "G", countyname: "宜蘭縣" },
                { countycode: "H", countyname: "桃園市" },
                { countycode: "I", countyname: "嘉義市" },
                { countycode: "J", countyname: "新竹縣" },
                { countycode: "K", countyname: "苗栗縣" },
                { countycode: "M", countyname: "南投縣" },
                { countycode: "N", countyname: "彰化縣" },
                { countycode: "O", countyname: "新竹市" },
                { countycode: "P", countyname: "雲林縣" },
                { countycode: "Q", countyname: "嘉義縣" },
                { countycode: "T", countyname: "屏東縣" },
                { countycode: "U", countyname: "花蓮縣" },
                { countycode: "V", countyname: "臺東縣" },
                { countycode: "W", countyname: "金門縣" },
                { countycode: "X", countyname: "澎湖縣" },
                { countycode: "Z", countyname: "連江縣" }
            ],
            input: {
                newimg: null,
                oldimg: null,
                name: "",
                tel: "",
                county: "",
                address: "",
                sort: 0,
                edit: null,
                index: null
            }
        };
    },
    methods: {
        //按下submit
        store(index) {
            if (this.input.edit == null) {//新增
                axios
                    .post("/admin/shop", {
                        img: this.input.oldimg,
                        name: this.input.name,
                        tel: this.input.tel,
                        county: this.input.county,
                        address: this.input.address,
                        sort: 0
                    })
                    .then(res => {
                        this.clear();
                        this.sweetalert("add");
                        this.shop_data.push(res.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {//編輯
                axios
                    .put(`/admin/shop/${this.input.edit}`, {
                        img: this.input.oldimg,
                        name: this.input.name,
                        tel: this.input.tel,
                        county: this.input.county,
                        address: this.input.address,
                        sort: this.input.sort
                    })
                    .then(res => {
                        console.log(res);

                        this.sweetalert("edit");
                        this.clear();
                        //兩個方法都可以重新渲染
                        this.$set(this.shop_data, index, res.data);
                        // this.shop_data.splice(index,1, res.data)
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //當頁面讀取完成後執行datatable
        upload() {
            $(document).ready(function () {
                $("#example").DataTable({
                    order: [5, "desc"]
                });
            });
        },
        //刪除
        deletedata(index) {
            //console.log(index);
            let target = this.shop_data[index];

            Swal.fire({
                title: `確定要刪除 ${target.name} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "確定",
                cancelButtonText: "取消"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/admin/shop/" + target.id)
                        .then(res => {
                            this.shop_data.splice(index, 1);
                            this.sweetalert("del");
                        })
                        .catch(err => {
                            console.log(err);
                        });
                }
            });
        },
        //讀取編輯資料
        editdata(index) {
            let target = this.shop_data[index];
            axios
                .get(`/admin/shop/${target.id}/edit`)
                .then(res => {
                    //console.log(res.data);
                    let {
                        id,
                        img,
                        name,
                        tel,
                        county,
                        address,
                        sort
                    } = res.data;
                    this.input.index = index;
                    this.input.edit = id;
                    this.input.oldimg = img;
                    this.input.name = name;
                    this.input.tel = tel;
                    this.input.county = county;
                    this.input.address = address;
                    this.input.sort = sort;
                    // console.log(res.data)
                })
                .catch(err => {
                    console.log(err);
                });
        },
        //判斷是否有圖片上傳
        processFile(event) {
            if (this.input.oldimg == null) {
                this.input.newimg = event.target.files[0];
                const fd = new FormData();
                fd.append("file", this.input.newimg, this.input.newimg.name);
                axios
                    .post("/admin/shop_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                axios
                    .post("/admin/shop_delete_img", {
                        file_link: this.input.oldimg
                    })
                    .then(function (response) {
                        //console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                this.input.newimg = event.target.files[0];
                const fd = new FormData();
                fd.append("file", this.input.newimg, this.input.newimg.name);
                axios
                    .post("/admin/shop_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //清除表單資料
        clear() {
            (this.input.newimg = null),
            (this.input.edit = null),
                (this.input.oldimg = ""),
                (this.input.name = ""),
                (this.input.tel = ""),
                (this.input.county = ""),
                (this.input.address = ""),
                (this.input.sort = "");
            $("#img").val("");
        },

        sweetalert(action) {
            if (action != "del") {
                Swal.fire({
                    icon: "success",
                    title: "儲存成功",
                    timer: 1500
                }).then(result => {
                    $("#add").click();
                });
            } else {
                Swal.fire({
                    icon: "success",
                    title: "刪除成功",
                    timer: 1500
                });
            }
        }
    }
};
</script>
