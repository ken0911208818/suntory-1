<template>
    <div class="container">
        <a id="add" href="#create" data-toggle="collapse" class="btn btn-success" @click="clear()">新增</a>

        <hr />

        <div class="collapse" id="create">
            <div class="card card-body">
                <form method="post" action="#" enctype="multipart/form-data" id="form1" @submit.prevent="store(input.index)">
                    <div class="form-group">
                        <div class="col-4">
                            <img :src="input.oldimg" alt srcset class="img-fluid" />
                        </div>

                        <label for="img">圖片</label>
                        <input v-if="this.input.edit == null" required type="file" class="form-control" multiple="multiple" @change="processFile($event)" id="img" name="img" value />
                        <input v-else type="file" class="form-control" multiple="multiple" @change="processFile($event)" id="img" name="img" value />

                        <file-upload class="btn btn-primary" post-action="/upload/post" extensions="gif,jpg,jpeg,png,webp" accept="image/png,image/gif,image/jpeg,image/webp" :multiple="true" :size="1024 * 1024 * 10" v-model="files" @input-filter="inputFilter" @input-file="inputFile" ref="upload">
                            <i class="fa fa-plus"></i>
                            Select files
                        </file-upload>

                        <button type="button" class="btn btn-success" v-if="!$refs.upload || !$refs.upload.active" @click.prevent="$refs.upload.active = true">
                            <i class="fa fa-arrow-up" aria-hidden="true"></i>
                            Start Upload
                        </button>
                        <button type="button" class="btn btn-danger" v-else @click.prevent="$refs.upload.active = false">
                            <i class="fa fa-stop" aria-hidden="true"></i>
                            Stop Upload
                        </button>

                    </div>
                    <div class="form-group">
                        <label for="content">故事內容</label>
                        <!-- <input type="text" class="form-control" v-model="input.content" id="content" name="content" required /> -->
                        <vue-editor v-model="input.content" :editor-toolbar="customToolbar" />
                    </div>
                    <div class="form-group">
                        <label for="title">故事標題</label>
                        <input type="text" class="form-control" v-model="input.title" id="title" name="title" required />
                    </div>
                    <div class="form-group">
                        <label for="liqueur_id">產品系列</label>
                        <select required name="liqueur_id" id v-model="input.id" class="form-control">
                            <option v-for="(item, index) in input.liqueur_kind" :value="item.id" :key="index">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="form-group" v-if="input.edit != null">
                        <label for="sort">權重</label>
                        <input type="number" class="form-control" v-model="input.sort" id="sort" name="sort" />
                    </div>

                    <button type="submit" class="btn btn-primary" data-target="#create">
                        Submit
                    </button>
                </form>
            </div>
            <hr />
        </div>

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>img</th>
                    <th>kind</th>
                    <th>title</th>
                    <th>content</th>
                    <th>sort</th>
                    <th width="80px">action</th>
                </tr>
            </thead>
            <tbody class="tbody">
                <tr v-for="(item, index) in liqueur_text" :key="index">
                    <td>
                        <img :src="item.img" alt srcset class="img-fluid" />
                    </td>
                    <td>{{ item.name.name }}</td>
                    <td>{{ item.title }}</td>

                    <td>{{ item.content }}</td>
                    <td v-if="item.sort == null">0</td>
                    <td v-else>{{ item.sort }}</td>
                    <td>
                        <a href="#create" class="btn btn-success btn-sm" data-toggle="collapse" @click="editdata(index)">修改</a>
                        <button class="btn btn-danger btn-sm" @click="deletedata(index)">
                            刪除
                        </button>
                    </td>
                    <div class="collapse" id>
                        <div class="card card-body"></div>
                    </div>
                    <div class="collapse" id>
                        <div class="card card-body"></div>
                    </div>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import FileUpload from 'vue-upload-component/src'
import { VueEditor } from "vue2-editor";
export default {
    components: { VueEditor, FileUpload: FileUpload },
    mounted() {
        console.log("Component mounted.");
    },
    created() {
        //獲取酒的種類
        axios
            .post("/admin/liqueurStory_kind")
            .then(response => (this.input.liqueur_kind = response.data))
            .catch(function (error) {
                console.log(error);
            });
        //獲取酒的故事
        axios
            .post("/admin/liqueurStory_text")
            .then(response => {
                this.liqueur_text = response.data;
                this.upload();
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    data() {
        return {
            files: [],
            liqueur_text: [],
            input: {
                newimg: null,
                oldimg: [],
                content: "",
                title: "",
                liqueur_kind: null,
                id: "",
                sort: 0,
                edit: null,
                index: null
            },
            customToolbar: [
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["code-block"]
            ]
        };
    },
    methods: {
        inputFilter(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                // Before adding a file
                // 添加文件前
                // Filter system files or hide files
                // 过滤系统文件 和隐藏文件
                if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
                    return prevent()
                }
                // Filter php html js file
                // 过滤 php html js 文件
                if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
                    return prevent()
                }
            }
        },
        inputFile(newFile, oldFile) {
            if (newFile && !oldFile) {
                // add
                console.log('add', newFile)
            }
            if (newFile && oldFile) {
                // update
                console.log('update', newFile)
            }
            if (!newFile && oldFile) {
                // remove
                console.log('remove', oldFile)
            }
        },
        //按下submit
        store(index) {
            if (this.input.edit == null) {
                let { content, title, img, id } = this.input;

                axios
                    .post("/admin/liqueurStory", {
                        liqueur_id: this.input.id,
                        img: this.input.oldimg,
                        content: this.input.content,
                        title: this.input.title
                    })
                    .then(res => {
                        this.clear();
                        this.sweetalert("add");
                        this.liqueur_text.push(res.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            } else {
                //console.log(index);

                axios
                    .put(`/admin/liqueurStory/${this.input.edit}`, {
                        liqueur_id: this.input.id,
                        img: this.input.oldimg,
                        content: this.input.content,
                        title: this.input.title,
                        sort: this.input.sort
                    })
                    .then(res => {
                        this.sweetalert("edit");
                        this.clear();
                        //兩個方法都可以重新渲染
                        this.$set(this.liqueur_text, index, res.data);
                        // this.liqueur_text.splice(index,1, res.data)
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
                    order: [1, "desc"]
                });
            });
        },
        //刪除
        deletedata(index) {
            //console.log(index);
            let target = this.liqueur_text[index];

            Swal.fire({
                title: `確定要刪除 ${target.title} ?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "確定",
                cancelButtonText: "取消"
            }).then(result => {
                if (result.value) {
                    axios
                        .delete("/admin/liqueurStory/" + target.id)
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
                .get(`/admin/liqueurStory/${target.id}/edit`)
                .then(res => {
                    //console.log(res.data);
                    let {
                        content,
                        img,
                        title,
                        id,
                        liqueur_id,
                        sort
                    } = res.data;
                    this.input.content = content;
                    this.input.title = title;
                    this.input.oldimg = img;
                    this.input.id = liqueur_id;
                    this.input.edit = id;
                    this.input.index = index;
                    this.input.sort = sort;
                    // console.log(res.data)
                })
                .catch(err => {
                    console.log(err);
                });
        },
        //判斷是否有圖片上傳
        processFile(event) {
            if (this.input.oldimg == '') {
                let length = event.target.files.length

                this.input.newimg = event.target.files[0];

                for (var i = 0; i < length; i++) {
                    this.input.newimg = event.target.files[i];
                    const fd = new FormData();
                    fd.append("file", this.input.newimg, this.input.newimg.name);
                    axios
                        .post("/admin/liqueurStory_upload_img", fd)
                        .then(response => {
                            if (this.input.oldimg[0] == null) {
                                this.input.oldimg.push(response.data)
                                console.log(response.data)

                            } else {
                                this.input.oldimg.push(response.data)
                                console.log('測試');

                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }


            } else {
                axios
                    .post("/admin/liqueurStory_delete_img", {
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
                    .post("/admin/liqueurStory_upload_img", fd)
                    .then(response => (this.input.oldimg = response.data))
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        //清除表單資料
        clear() {
            //console.log("aa");

            (this.input.newimg = null),
                (this.input.oldimg = ""),
                (this.input.content = ""),
                (this.input.title = ""),
                (this.input.id = ""),
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

