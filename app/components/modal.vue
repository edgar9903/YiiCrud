<template>
    <!-- Modal -->
    <div id="myModal" class="modal fade " :class="{'in d-block op-1': showModal}"  role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content mt-5">
                <form @submit.prevent="formNewsUpdate" >
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <p v-if="errors.name" class="text-danger">{{ errors.name[0] }}</p>
                            <input type="text" id="name" class="form-control" required v-model="name" >
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <p v-if="errors.image" class="text-danger">{{ errors.image[0] }}</p>
                            <div class="w-100">
                                <img :src="current_image"  class="w-100">
                            </div>
                            <input type="file" id="image" class="form-control p-1 mt-2"  @change="processFile($event)">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <p v-if="errors.description" class="text-danger">{{ errors.description[0] }}</p>
                            <textarea name="description" id="description" class="form-control" required v-model="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info">Upload</button>
                        <button type="button" class="btn btn-danger" @click="hideModal" >Close</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</template>

<script>

    export default {
        props: {
            showModal: {
                type: Boolean,
                required: true,
            },
            hideModal: {
                type: Function,
                default: () => {
                    return 'default'
                }
            },
            data: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {
                name: '',
                image: {},
                description: '',
                current_image: '',
                errors: {},
            }
        },
        watch: {
            data:function (to,from) {
                this.name = to.name;
                this.description = to.description;
                this.current_image = to.image;
            }
        },
        methods: {
            processFile(event) {
                this.image = event.target.files[0];
            },
            formNewsUpdate(){

                let formData = new FormData();

                formData.append('News[name]', this.name);
                formData.append('News[description]', this.description);
                formData.append('News[image]', this.image);
                formData.append('id',this.data.id)

                axios.post('news/update/',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data;'
                    }
                })
                    .then((response) => {
                        if (response.data.result) {
                            this.hideModal();
                        }
                    })
                    .catch((error) =>{
                        console.log(error)
                    })

            }
        }

    }
</script>

<style scoped>
    .op-1{
        opacity: 1;
    }
    .close-icon{
        font-size: 24px;

    }
</style>