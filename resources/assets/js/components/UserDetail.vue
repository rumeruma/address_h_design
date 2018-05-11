<template>
    <div>
        <div @click="startEdit">
        <user-info :info="user_info" ref="userinfo" @interface="getBool"></user-info>

        <user-contacts :numbers="user_contacts" ref="usercontacts" @click="startEdit"></user-contacts>
        <user-links :links_url="user_links" ref="userlinks" ></user-links>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div v-if="isEdit">
                    <hr>
                    <button @click="checkBool" class="btn btn-xs" >Save Changes</button>
                    <button @click="cancelEdit" class="btn btn-xs btn-danger" >Cancel Changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import UserInfo from '../components/UserInfo.vue'
    import UserContacts from '../components/UserContacts.vue';
    import UserLinks from '../components/UserLinks.vue';

    export default {
        props:['detail'],
        components: {UserInfo, UserContacts,UserLinks},
        data(){
            return{
                isEdit: false,
                user_info:this.detail,
                user_links: this.detail.links,
                user_contacts:this.detail.cell_numbers
            }
        },

        methods:{

            getBool:function(bool){
                console.log(bool)
            },

            checkBool:function(){
                this.isEdit =false;
                this.user_info = this.$refs.userinfo.GetData();
                this.user_contacts = this.$refs.usercontacts.GetContacts();
                this.user_links = this.$refs.userlinks.Getlinks();

                axios.put('my-profile/'+this.detail.id, {
                    'first_name': this.user_info.first_name,
                    'last_name': this.user_info.last_name,
                    'organization': this.user_info.organization,
                    'designation': this.user_info.designation,
                    'cell_numbers': this.user_contacts,
                    'links': this.user_links
                }).catch(function (error) {
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
            startEdit(){
                this.isEdit = true;
            },
            cancelEdit(){
                this.isEdit = false;
                this.$refs.userinfo.cancelEdit();
            }

        }
    }
</script>

