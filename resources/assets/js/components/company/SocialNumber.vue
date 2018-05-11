<template>
    <div>

        <user-contacts :numbers="comp_contacts" ref="usercontacts"></user-contacts>
        <user-links :links_url="comp_links" ref="userlinks"></user-links>
        <button @click="saveChange" class="btn btn-xs" >Save Changes</button>
        <!--<button @click="cancelEdit" class="btn btn-xs btn-danger" >Cancel Changes</button>-->
    </div>
</template>

<script>

    import UserContacts from '../../components/UserContacts.vue';
    import UserLinks from '../../components/UserLinks.vue';

    export default {
        props: {
            urlz: String,
            postid: {
                type: String,
                default: ''
            },
            contacts: String,
            socials: String,
        },
        data() {
            return {
                comp_contacts: JSON.parse(this.contacts),
                comp_links: JSON.parse(this.socials),
                isEdit: false,
            }

        },
        components: {UserContacts, UserLinks},
        methods: {
            saveChange(){
                this.isEdit = false;
                axios.post(this.urlz, {
                    'meta': {'contacts':this.$refs.usercontacts.GetContacts(), 'links': this.$refs.userlinks.Getlinks()}, 'post':this.postid

                }).catch(function (error) {
                    console.log(error);
                }).then(function(){
                    swal({
                        title: "Updating Contacts and Links",
                        text: 'please wait',
                        timer: 3000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === swal.DismissReason.timer) {

                        }

                        swal(
                            'Contacts and Links',
                            'Has been updated successfully',
                            'success'
                        )
                    });
                });
            },
            cancelEdit(){
                this.isEdit = false;
            }

        }

    }


</script>

