<template>
    <div>
        <img :src="imgsrc" alt="">
        <input type="file" name="media" @change="GetMedia">
        <a href="#" v-if="loaded" class="btn btn-success" @click.prevent="upload">Upload</a>
        <a href="#" v-if="loaded" class="btn btn-danger" @click.prevent="cancel">Cancel</a>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data(){
            return {
                imgsrc:this.user.avatar,
                loaded:false,
                file:null
            }
        },
        methods:{

            GetMedia(e){
                let image = e.target.files[0];
                let form = new FormData();
                form.append('media', image);
                this.file = form;
                this.read(image);

            },

            upload(){
                this.loaded = false;
                axios.post('my-profile/avatar', this.file).catch(function (error) {
                    console.log(error.response.data);
                }).then(res = this.$toasted.show('Updated'));

            },

            read(image){
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.imgsrc = reader.result;
                }
                this.loaded = true;
            },

            cancel(){
                this.imgsrc = this.user.avatar;
                this.loaded = false;
            }
        }
    }
</script>