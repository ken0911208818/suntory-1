<template>
    <div class="container">
        <v-app>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header v-toolbar v-toolbar--dense v-toolbar--flat grey d-flex align-center">
                            <h5 v-if="this.input.edit == null" class="modal-title" id="staticBackdropLabel">新增</h5>
                            <h5 v-else class="modal-title" id="staticBackdropLabel">編輯</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="clear()">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="form1" enctype="multipart/form-data" @submit.prevent="store(input.index)">
                                <div class="form-group">
                                    <label for="liqueur_id">酒類名字</label>
                                    <input type="text" class="form-control" v-model="input.name" id="name" name="name" required />
                                </div>
                                <div class="form-group">
                                    <div class="row" v-if="input.oldimg !=null" style="position: relative">
                                        <div class="col-4 " v-for="(item ,index) in input.oldimg" :key="index">
                                            <img :src="item.img" alt srcset class="img-fluid" v-if="typeof item == 'object' ">
                                            <img :src="item" alt srcset class="img-fluid" v-else>
                                            <button type="button" class="btn btn-danger" style="position: absolute;border-radius: 50%;top: -15px;right: -5px;" @click="deleteimg(index)">X</button>
                                        </div>
                                    </div>
                                    <label for="img">輪播圖</label>
                                    <input v-if="this.input.edit == null" required type="file" class="form-control" multiple="multiple" @change="processFile($event)" id="img" name="img" value />
                                    <input v-else type="file" class="form-control" multiple="multiple" @change="processFile($event)" id="img" name="img" value />
                                </div>
                                <div class="form-group">
                                    <label for="story">故事區塊的名稱(不填則區塊不顯示)</label>
                                    <input type="text" class="form-control" v-model="input.story" id="story" name="story" />
                                </div>
                                <div class="form-group">
                                    <label for="attitude">態度區塊的名稱(不填則區塊不顯示)</label>
                                    <input type="text" class="form-control" v-model="input.attitude" id="attitude" name="attitude" />
                                </div>
                                <div class="form-group">
                                    <label for="sure">肯定區塊的名稱(不填則區塊不顯示)</label>
                                    <input type="text" class="form-control" v-model="input.sure" id="sure" name="sure" />
                                </div>
                                <div class="form-group">
                                    <label for="method">蒸餾廠區塊的名稱(不填則區塊不顯示)</label>
                                    <input type="text" class="form-control" v-model="input.method" id="method" name="method" />
                                </div>
                                <div class="form-group">
                                    <label for="product">系列區塊的名稱(不填則區塊不顯示)</label>
                                    <input type="text" class="form-control" v-model="input.product" id="product" name="product" />
                                </div>
                                <div class="form-group" v-if="input.edit != null">
                                    <label for="sort">權重</label>
                                    <input type="number" class="form-control" v-model="input.sort" id="sort" name="sort" value="0" />
                                </div>
                                <br>
                                <v-btn class="mx-2" fab dark small color="blue" type="submit">儲存</v-btn>
                                <v-btn class="mx-2" fab dark small color="gray" data-dismiss="modal" @click="clear()">取消</v-btn>
                                <br>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <v-card>
                <v-card-title class="v-toolbar v-toolbar--dense v-toolbar--flat grey lighten-1">
                    <div class="d-flex justify-content-end mr-3">
                        <v-btn class="mx-2" fab dark small color="blue" data-toggle="modal" data-target="#staticBackdrop" @click="clear()">
                            新增
                        </v-btn>

                        <v-btn class="mx-2" fab dark small color="black" @click="darks()">
                            <svg class="bi bi-circle-half" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15V1a7 7 0 000 14zm0 1A8 8 0 108 0a8 8 0 000 16z" clip-rule="evenodd" />
                            </svg>
                        </v-btn>
                    </div>
                    <h1>酒類管理</h1>
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                </v-card-title>
                <v-data-table :headers="headers" :items="liqueur_text" :search="search" :items-per-page="10" :loading="false" :dark="dark" :multi-sort="true">
                    <template v-slot:item.action="{ item }">
                        <div class="d-flex justify-content-center my-3">
                            <v-btn class="mx-2" fab dark small color="#5F04B4" @click="getPreviewImg(item)" data-toggle="modal" data-target="#imgModal">
                                縮圖
                            </v-btn>
                            <v-btn class="mx-2" fab dark small color="green" @click="editdata(liqueur_text.indexOf(item))" data-toggle="modal" data-target="#staticBackdrop">
                                編輯
                            </v-btn>
                            <v-btn class="mx-2" fab dark small color="pink" @click="deletedata(liqueur_text.indexOf(item))">
                                刪除
                            </v-btn>
                        </div>
                    </template>
                </v-data-table>
            </v-card>

            <!-- Modal -->
            <div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModalTitle" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="clear()">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div v-if="input.oldimg !=null" class="text-center">
                                <div v-for="(item ,index) in input.oldimg" :key="index" class="m-2">
                                    <img :src="item.img" style="max-width:80%" srcset class="img-fluid" v-if="typeof item == 'object' ">
                                    <img :src="item" style="max-width:80%" srcset class="img-fluid" v-else>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </v-app>
    </div>
</template>

<script>
import axios from "axios";

export default {
    mounted() {
        console.log("Component mounted.");
    },
    props: ["dataAll"],
    data() {
        return {
            files: [],
            previewImg: [],
            liqueur_text: JSON.parse(this.dataAll),
            search: '',
            dark: false,
            input: {
                newimg: null,
                oldimg: [],
                name: "",
                sort: 0,
                edit: null,
                index: null,
                story: null,
                attitude: null,
                sure: null,
                product: null,
                method: null,
            },
            headers: [
                { text: '酒類名字', value: 'name', align: 'center', },
                { text: '故事區塊標題', value: 'story', align: 'center', },
                { text: '態度區塊標題', value: 'attitude', align: 'center', },
                { text: '肯定區塊標題', value: 'sure', align: 'center', },
                { text: '蒸餾廠區塊標題', value: 'method', align: 'center', },
                { text: '系列區塊標題', value: 'product', align: 'center', },
                { text: '權重', value: 'sort', align: 'center', filterable: false, },
                { text: '', value: 'action', align: 'center', filterable: false, sortable: false, },
            ],
        };
    },
    methods: {
        getPreviewImg(item) {
            this.input.oldimg = item.imgs;
        },
        darks() {
            if (this.dark) {
                $('td').css('color', 'black');
            } else {
                $('td').css('color', 'white');
            }
            this.dark = !this.dark
        },
        //按下submit
        store(index) {
            $('#staticBackdrop').modal('hide');

            if (this.input.edit == null) {
                let { name, story, attitude, sure, product, method, oldimg } = this.input;

                axios
                    .post("/admin/liqueur", {
                        img: oldimg,
                        name: name,
                        story: story,
                        attitude: attitude,
                        sure: sure,
                        product: product,
                        method: method,
                        sort: 0
                    })
                    .then(res => {
                        console.log(res);

                        this.sweetalert("add");
                        this.liqueur_text.unshift(res.data);
                        this.clear();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                let { name, story, attitude, sure, product, method, oldimg, sort } = this.input
                axios
                    .put(`/admin/liqueur/${this.input.edit}`, {
                        img: oldimg,
                        name: name,
                        story: story,
                        attitude: attitude,
                        sure: sure,
                        product: product,
                        method: method,
                        sort: sort
                    })
                    .then(res => {
                        this.sweetalert("edit");
                        //兩個方法都可以重新渲染
                        this.$set(this.liqueur_text, index, res.data);
                        // this.liqueur_text.splice(index,1, res.data)
                        this.clear();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //刪除
        deletedata(index) {
            //console.log(index);
            let target = this.liqueur_text[index];

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
                        .delete("/admin/liqueur/" + target.id)
                        .then(res => {
                            this.liqueur_text.splice(index, 1);
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
            let target = this.liqueur_text[index];
            axios
                .get(`/admin/liqueur/${target.id}/edit`)
                .then(res => {
                    let { name, story, attitude, sure, product, method, sort, id, imgs } = res.data
                    this.input.name = name
                    this.input.story = story
                    this.input.attitude = attitude
                    this.input.sure = sure
                    this.input.product = product
                    this.input.method = method
                    this.input.edit = id;
                    this.input.index = index;
                    this.input.sort = sort
                    imgs.forEach(element => {
                        this.input.oldimg.push(element.img)
                    });
                })
                .catch(err => {
                    console.log(err);
                });
        },
        //判斷是否有圖片上傳
        processFile(event) {
            let length = event.target.files.length;

            this.input.newimg = event.target.files[0];

            for (var i = 0; i < length; i++) {
                this.input.newimg = event.target.files[i];
                const fd = new FormData();
                fd.append(
                    "file",
                    this.input.newimg,
                    this.input.newimg.name
                );
                axios
                    .post("/admin/liqueurStory_upload_img", fd)
                    .then((response) => {
                        if (!this.input.oldimg) {
                            this.input.oldimg = [response.data]
                        } else {
                            this.input.oldimg.push(response.data)
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        deleteimg(index) {
            if (this.input.edit == null) {
                axios
                    .post("/admin/liqueurStory_delete_img", {
                        file_link: this.input.oldimg[index]
                    })
                    .then((res) => {
                        this.input.oldimg.splice(index, 1)
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                if (typeof this.input.oldimg[index] == 'object') {
                    axios
                        .post("/admin/liqueur_delete_img", {
                            id: this.input.oldimg[index].id,
                            file_link: this.input.oldimg[index].img
                        })
                        .then((res) => {
                            this.input.oldimg.splice(index, 1)
                            this.input.oldimg[index].img
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    axios
                        .post("/admin/liqueurStory_delete_img", {
                            file_link: this.input.oldimg[index]
                        })
                        .then((res) => {
                            this.input.oldimg.splice(index, 1)
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        },
        //清除表單資料
        clear() {
            this.input.newimg = null,
                this.input.oldimg = [],
                this.input.name = "",
                this.input.story = null,
                this.input.attitude = null,
                this.input.sure = null,
                this.input.product = null,
                this.input.method = null,
                this.input.edit = null,
                this.input.index = null;
            $("#img").val("");
        },

        sweetalert(action) {
            if (action != "del") {
                Swal.fire({
                    icon: "success",
                    title: "儲存成功",
                    timer: 1500
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
