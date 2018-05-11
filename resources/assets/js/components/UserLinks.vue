<template>
    <div>
        <br>
        <p>
            <a class="btn btn-default" v-for="(link, index) in links" :href="link.url" role="button" target="_blank">
                <i class="fa" :class="'fa-'+link.type"></i>
            </a>&nbsp;
        </p>
        <div v-if="showModal">
            <transition name="modal">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" @click="showModal=false">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title">Add/Edit Links</h4>
                                </div>
                                <div class="modal-body">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td><strong>Type</strong></td>
                                            <td><strong>url</strong></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(link, index) in links">

                                            <td>
                                                <select class="form-control" v-model="link.type">
                                                    <option v-for="type in types" v-bind:value="type.value">{{ type.text }}</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control" type="url" v-model="link.url"></td>
                                            <td>
                                                <a v-on:click="removeElement(index);" style="cursor: pointer">Remove</a>
                                            </td>


                                        </tr>
                                        </tbody>
                                    </table>

                                    <div>
                                        <button class="btn btn-xs btn-info" @click="addLinks">Add link</button>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" @click="cancelEdit" data-dismiss="modal">Cancel Changes</button>
                                    <button type="button" class="btn btn-primary" @click="saveEdit">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <button class="btn btn-xs btn-default" id="show-modal" @click="showModal = true">Add/Edit links</button>

    </div>
</template>

<script>

    export default {
        props:['links_url'],
        data() {
            return{
                links: this.links_url,
                types:[
                    { text: 'Facebook', value: 'facebook' },
                    { text: 'Twitter', value: 'twitter' },
                    { text: 'G+', value: 'google-plus' },
                    { text: 'Youtube', value: 'youtube' },
                    { text: 'Linkedin', value: 'linkedin' },
                    { text: 'Linkedin', value: 'linkedin' },
                    { text: 'Others', value: 'globe' },
                ],
                showModal:false,
                linkText: '',
                lastLimit: 7
            }
        },
        methods: {
            addLinks: function() {
                var elem = document.createElement('tr');
                if (this.links.length <= this.lastLimit) {
                    this.links.push({
                        type: "",
                        url: ""
                    });
                } else {
                    this.$toasted.show('!!Sorry Maximum Url limit is 8', {
                        'position':'top-center',
                        'action' :{
                            text : 'close',
                            onClick : (e, toastObject) => {
                            toastObject.goAway(0);
                            }
                        }
                    })
                }

            },
            removeElement: function(index) {
                this.links.splice(index, 1);
            },
            cancelEdit: function(){
                this.showModal = false;
                this.links = [];
            },
            saveEdit:function(){
                this.linkText = '';
                this.showModal = false;
                this.links.forEach(function(element){
                    this.linkText += '<a href="'+element.url+'"><i class="fa fa-'+element.type+'"></i></a>&nbsp;';
                    // console.log(element.type+":"+element.url+",");
                }, this);
            },
            Getlinks:function(){
                const exportlinks = this.links;
                return exportlinks;
            }
        }
    };
</script>

<style scope>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

</style>