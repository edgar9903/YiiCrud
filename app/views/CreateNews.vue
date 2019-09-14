<template>
    <div class="container">
        <form @submit.prevent="formNewsCreate" class="w-50 mx-auto">
            <div class="form-group">
                <label for="name">Name</label>
                <p v-if="errors.name" class="text-danger">{{ errors.name[0] }}</p>
                <input type="text" id="name" class="form-control" required v-model="name">
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <p v-if="errors.image" class="text-danger">{{ errors.image[0] }}</p>
                <input type="file" id="image" class="form-control p-1" required @change="processFile($event)">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <p v-if="errors.description" class="text-danger">{{ errors.description[0] }}</p>
                <textarea name="description" id="description" class="form-control" required v-model="description"></textarea>
            </div>
            <div class="text-right">
                <button class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                image: {},
                description: '',
                errors: {},
            }
        },
        methods: {
            processFile(event) {
                this.image = event.target.files[0];
            },
            formNewsCreate(){

                let data = new FormData();

                data.append('News[name]', this.name);
                data.append('News[description]', this.description);
                data.append('News[image]', this.image);

                axios.post('news/create/',data,{
                    headers: {
                        'Content-Type': 'multipart/form-data;'
                    }
                })
                    .then((response) => {
                        if (response.data.result) {
                            this.$router.push({name:'news'})
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

</style>