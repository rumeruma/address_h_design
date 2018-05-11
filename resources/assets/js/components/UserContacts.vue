<template>
    <div>

        <p>
            <span v-for="(contact, index) in contacts">{{ contact.type }} : {{ contact.number }}, </span>
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
                                    <h4 class="modal-title">Add/Edit Contacts</h4>
                                </div>
                                <div class="modal-body">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td><strong>Type</strong></td>
                                            <td><strong>Number</strong></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(contact, index) in contacts">

                                            <td>
                                                <select class="form-control" v-model="contact.type">
                                                    <option v-for="type in types">{{type}}</option>
                                                </select>
                                            </td>
                                            <td><input class="form-control" type="text" v-model="contact.number"></td>
                                            <td>
                                                <a v-on:click="removeElement(index);" style="cursor: pointer">Remove</a>
                                            </td>


                                        </tr>
                                        </tbody>
                                    </table>

                                    <div>
                                        <button class="btn btn-xs btn-info" @click="addContact">Add contact</button>
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

        <button class="btn btn-xs btn-default" id="show-modal" @click="showModal = true">Add/Edit Contacts</button>

    </div>
</template>

<script>
    export default {
        props:['numbers'],
        data() {
            return{
            contacts: this.numbers,
            types:['home','office','personal','other'],
            showModal:false,
            contactText: '',
            lastLimit: 2
            }
        },
        methods: {
            addContact: function() {
                var elem = document.createElement('tr');
                if (this.contacts.length <= this.lastLimit) {

                    this.contacts.push({
                        type: "",
                        number: ""
                    });
                } else {
                    this.$toasted.show('Sorry Maximum contact limit is 3', {
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
                this.contacts.splice(index, 1);
            },
            cancelEdit: function(){
                this.showModal = false;
                this.contacts = [];
            },
            saveEdit:function(){
                this.contactText = '';
                this.showModal = false;
                this.contacts.forEach(function(element){
                this.contactText += element.type+":"+element.number+",";
                // console.log(element.type+":"+element.number+",");
                }, this);
            },
            GetContacts:function(){
                const exportContacts = this.contacts;
                return exportContacts;
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