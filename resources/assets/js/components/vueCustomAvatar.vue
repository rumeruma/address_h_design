<template>
    <div>

        <div v-if="!cropped">
            <vue-avatar
                    :width=200
                    :height=200
                    ref="vueavatar"
                    @vue-avatar-editor:image-ready="onImageReady"
                    :image="imgsrc"
            >
            </vue-avatar>

            <vue-avatar-scale
                    ref="vueavatarscale"
                    @vue-avatar-editor-scale:change-scale="onChangeScale"
                    :width=250
                    :min=1
                    :max=3
                    :step=0.02
            >
            </vue-avatar-scale>
            <div class="btn-group btn-group-xs" style="margin-top: 1rem" role="group" aria-label="...">
            <button class="btn btn-xs btn-default" v-on:click="saveClicked"><i class="fa fa-floppy-o"></i></button>
            <button class="btn btn-xs btn-default" v-on:click="cancelClicked"><i class="fa fa-ban"></i></button>
            </div>
        </div>

        <div v-else>
            <img class="img-circle" :src="imgsrc" alt="">
            <button class="btn btn-circle btn-circle-micro btn-info" v-on:click="startEdit"><i class="fa fa-pencil-square-o"></i></button>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import VueAvatar from '../components/VueAvatar.vue'
    import VueAvatarScale from '../components/VueAvatarScale.vue'

    export default {
        props:['user'],
        components: {
            VueAvatar,
            VueAvatarScale
        },
        data(){

            return {
                imgsrc:this.user.avatar,
                cropped:true,
            }
        },
        methods:{
            onChangeScale (scale) {
                this.$refs.vueavatar.changeScale(scale)
            },
            saveClicked(){
                var img = this.$refs.vueavatar.getImageScaled()
                this.imgsrc = img.toDataURL()
                this.cropped = true;

                axios.post('my-profile/avatar', {'media': this.imgsrc}).catch(function (error) {
                    console.log(error.response.data);
                }).then(
                    this.$toasted.show('Updated', {
                        'position':'top-center',
                        'action' :{
                            text : 'close',
                            onClick : (e, toastObject) => {
                            toastObject.goAway(0);
                                }
                            }
                        })
                );

            },
            onImageReady(scale){
                this.$refs.vueavatarscale.setScale(scale)
            },
            startEdit(){
                this.cropped = false;
            },
            cancelClicked(){
                this.cropped = true;
                this.$toasted.show('Cancelled',
                    {
                        'position':'top-center',
                        'action' :{
                            text : 'close',
                            onClick : (e, toastObject) => {
                            toastObject.goAway(0);
                                }
                            }
                    })
            }
        }
    }
</script>

