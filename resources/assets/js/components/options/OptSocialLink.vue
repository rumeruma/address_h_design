<template>
    <div>
        <user-links :links_url="comp_links" ref="userlinks"></user-links>
        <hr>
        <button @click="saveChange" class="btn btn-xs" >Save Changes</button>
    </div>
</template>

<script>


    import UserLinks from '../../components/UserLinks.vue';

    export default {
        props: {
            urlz: String,
            postid: {
                type: String,
                default: ''
            },
            socials: String,
        },
        data() {
            return {
                comp_links: JSON.parse(this.socials),
                isEdit: false,
            }

        },
        components: {UserLinks},
        methods: {
            saveChange:function(){
                this.isEdit = false;
                axios.put(this.urlz, {value: this.$refs.userlinks.Getlinks(), name:"social-links"

                }).catch(function (error) {
                    console.log(error);
                }).then(function(){
                    swal({
                        title: "Updating Social Links",
                        text: 'please wait',
                        timer: 3000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === swal.DismissReason.timer) {

                        }

                        swal(
                            'Social Links',
                            'Has been updated successfully',
                            'success'
                        )
                    });
                });
            },
            cancelEdit:function(){
                this.isEdit = false;
            }

        }

    }


</script>

