<template>
    <div class="row">
        <div class="col-md-4">
            <div class="ev" v-for="(vdo, index) in vdos">
                <div class="input-group">
                    <input type="url" class="form-control" v-model="vdo.url">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button" v-on:click="removeVdos(index);">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div ref="carousel" style="min-height: 300px" class="owl-carousel owl-theme">
                <div v-for="(vdo, index) in vdos" class="item-video" :data-merge="(index+1)"><a class="owl-video"
                                                                                                :href="vdo.url"></a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
            <button type="button" v-on:click="addVideo()" class="btn btn-info">Add Video Url</button>
            <button type="button" v-on:click="preview()" class="btn btn-info">Preview</button>
            <button type="button" v-on:click="saveVdos()" class="btn btn-info">Save</button>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            vdosize: String,
            vdosin: String,
            urlz: String,
            postid: {
                type: String,
                default: ''
            },
        },
        data() {
            return {
                vdolimit: parseInt(this.vdosize) - 1,
                vdos: JSON.parse(this.vdosin),
                post: this.postid,
                urlx: this.urlz,
                carousel:null,
            }
        },
        methods: {
            addVideo: function () {
                if (this.vdos.length <= this.vdolimit) {
                    this.vdos.push({
                        url: ""
                    });
                } else {
                    swal('Sorry!', 'You Cant Add More Videos', 'warning')
                }
                // console.log("voda"+this.urlx)
            },
            removeVdos: function (index) {
                this.vdos.splice(index, 1);
            },
            saveVdos: function () {

                axios.post(this.urlx, {
                    'meta': {'vdo': this.vdos}, 'post': this.post

                }).catch(function (error) {
                    console.log(error.response.data);
                }).then(function () {
                    swal({
                        title: "Updating Videos",
                        text: 'please wait',
                        timer: 3000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === swal.DismissReason.timer) {

                        }

                        swal(
                            'Videos',
                            'Has been updated successfully',
                            'success'
                        )
                    });
                });

            },
            preview: function () {
                let slider = this.carousel;
                $(document).ready(function () {
                    slider.trigger('change.owl.carousel');
                });
            }
        },
        watch:{
            vdosin:{
                handler: function () {
                    let slider = this.carousel;
                    $(document).ready(function () {
                        slider.trigger('change.owl.carousel');
                    });

                }, deep: true
            }
        },
        mounted: function () {
            let fx = this.vdos.length;
            this.carousel = $('.owl-carousel');
            let slider = this.carousel;
            $(document).ready(function () {
                if(fx > 1) {
                   slider.owlCarousel({
                        items: 1,
                        merge: false,
                        loop: true,
                        margin: 10,
                        video: true,
                        lazyLoad: true,
                        center: true,
                    });
                }
            });

        }
    }
</script>

<style scoped>

</style>