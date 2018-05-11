<template>
    <div class="panel panel-default">
        <div class="panel-heading">Add Branches
            <button type="button" class="btn btn-xs btn-success" @click="showModal=true"><i class="fa fa-plus"></i>
            </button>
        </div>
        <div class="panel-body">
            <div v-for="(br, index) in branches" class="row">
                <div class="col-md-6">
                    <address>
                        <strong>{{ br.name }}</strong><br>
                        {{ br.address }}<br>
                        {{ br.email }}<br>
                        {{ br.contact }}<br>
                    </address>
                </div>
                <div class="col-md-6">

                        <div :id="'n_control'+index">
                            <button type="button" class="btn btn-xs btn-info" @click="setEditor(index)">Edit</button>
                            <button type="button" class="btn btn-xs btn-danger" @click="removeBranch(index)">Remove</button>
                        </div>

                        <div :id="'n_editor'+index" class="noc">
                            <div class="form-group-sm">
                                <label :for="'inputName'+index">Branch Name</label>

                                <input type="text" class="form-control" :id="'inputName'+index" v-model="br.name"
                                       placeholder="Name">

                            </div>
                            <div class="form-group-sm">
                                <label :for="'inputAddress'+index">Branch Address</label>

                                <input type="text" class="form-control" :id="'inputAddress'+index" v-model="br.address"
                                       placeholder="Address">

                            </div>
                            <div class="form-group-sm">
                                <label :for="'inputEmail'+index">Branch Email</label>

                                <input type="email" class="form-control" :id="'inputEmail'+index" v-model="br.email"
                                       placeholder="Email">

                            </div>
                            <div class="form-group-sm">
                                <label :for="'inputPhone'+index">Branch Contact Number</label>

                                <input type="email" class="form-control" :id="'inputPhone'+index" v-model="br.contact"
                                       placeholder="Contact Number">

                            </div>
                            <button type="button" class="btn btn-xs btn-success" @click="unsetEditor(index)">Done
                            </button>
                        </div>

                </div>
                <div class="col-md-12"><hr></div>
            </div>


        </div>

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
                                    <h4 class="modal-title">Add a Branch</h4>
                                </div>
                                <div class="modal-body">

                                    <div>
                                        <div class="form-group-sm">
                                            <label for="inputNameX">Branch Name</label>

                                            <input type="text" class="form-control" id="inputNameX"
                                                   v-model="branch.name" placeholder="Name">

                                        </div>
                                        <div class="form-group-sm">
                                            <label for="inputAddressX">Branch Address</label>

                                            <input type="text" class="form-control" id="inputAddressX"
                                                   v-model="branch.address" placeholder="Address">

                                        </div>
                                        <div class="form-group-sm">
                                            <label for="inputEmailX">Branch Email</label>

                                            <input type="email" class="form-control" id="inputEmailX"
                                                   v-model="branch.email" placeholder="Email">

                                        </div>
                                        <div class="form-group-sm">
                                            <label for="inputPhoneX">Branch Contact Number</label>

                                            <input type="email" class="form-control" id="inputPhoneX"
                                                   v-model="branch.contact" placeholder="Contact Number">

                                        </div>

                                    </div>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" @click="showModal=false"
                                            data-dismiss="modal">Cancel Changes
                                    </button>
                                    <button type="button" class="btn btn-primary" @click="addBranch()">Save changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

        <div class="panel-footer">
            <button type="button" class="btn btn-success" @click="saveBranches()">Save Branches</button>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            urlz: String,
            postid: {
                type: String,
                default: ''
            },
            dbranches: String,
        },
        data() {
            return {
                showModal: false,
                branch: {name: '', address: '', email: '', contact: ''},
                branches: JSON.parse(this.dbranches),
            }
        },

        methods: {
            addBranch: function () {
                this.branches.push(this.branch);
                this.showModal = false;
            },
            setEditor: function (index) {
                $('#n_editor'+index).show('slow','linear');
                $('#n_control'+index).hide('slow','linear');
            },
            unsetEditor:function(index){
                $('#n_editor'+index).hide('slow','linear');
                $('#n_control'+index).show('slow','linear');
            },
            removeBranch: function(index) {
                this.branches.splice(index, 1);
            },
            saveBranches:function(){
                axios.post(this.urlz, {
                    'meta': {'branches':this.branches}, 'post':this.postid

                }).catch(function (error) {
                    console.log(error);
                }).then(function(){
                    swal({
                        title: "Updating Branches",
                        text: 'please wait',
                        timer: 3000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(function (result) {
                        if (result.dismiss === swal.DismissReason.timer) {

                        }

                        swal(
                            'Branches',
                            'Has been updated successfully',
                            'success'
                        )
                    });
                });
            }
        },
        watch: {
            // whenever question changes, this function will run
            showModal: function (val) {
                if (val == false) {
                    this.branch = {name: '', address: '', email: '', contact: ''};
                }
            },
            // branches: {
            //     handler: function () {
            //
            //         console.log(this.editor)
            //     }, deep: true
            // }
        },
        mounted: function () {

        }

    }
</script>

<style scoped>

    .noc{ display:none; }

</style>