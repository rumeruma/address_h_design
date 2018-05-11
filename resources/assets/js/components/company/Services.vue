<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="ev" v-for="(service, index) in services">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="service.text">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button" v-on:click="removeServices(index);">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12">
            <hr>
            <button type="button" v-on:click="addService()" class="btn btn-info">Add Service</button>
            <button type="button" v-on:click="saveServices()" class="btn btn-info">Save</button>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            servicesIn: String,
            urlz: String,
            postid: {
                type: String,
                default: ''
            },
        },
        data() {
            return {
                services: JSON.parse(this.servicesIn),
                post: this.postid,
                urlx: this.urlz,
            }
        },
        methods: {
            addService: function () {

                    this.services.push({
                        text: ""
                    });

                // console.log("voda"+this.urlx)
            },
            removeServices: function (index) {
                this.services.splice(index, 1);
            },
            saveServices: function () {

                axios.post(this.urlx, {
                    'meta': {'services': this.services}, 'post': this.post

                }).catch(function (error) {
                    console.log(error.response.data);
                }).then(function () {
                    swal({
                        title: "Updating Services",
                        text: 'please wait',
                        timer: 3000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === swal.DismissReason.timer) {

                        }

                        swal(
                            'Services',
                            'Has been updated successfully',
                            'success'
                        )
                    });
                });

            },
            
        },
        watch:{
            
        },
        mounted: function () {
           
        }
    }
</script>

<style scoped>

</style>