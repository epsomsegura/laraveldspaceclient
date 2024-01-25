<div x-data="data()" x-init="init()" wire:ignore>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js"></script>
    <style>
        .list-container {
            max-height: 250px;
            overflow-y: scroll;
        }

        .list-container::-webkit-scrollbar {
            width: 10px !important;
        }

        .list-container::-webkit-scrollbar-track {
            background-color: #fff;
        }

        .list-container::-webkit-scrollbar-thumb {
            background-color: #babac0;
            border-radius: 16px;
            border: 4px solid #fff;
        }

        .list-container::-webkit-scrollbar-button {
            display: none;
        }
    </style>

    <div class="container">
        <div class="row">
            <template x-if="communities">
                <div class="col-12 col-md-6 col-lg-4 my-4">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div x-show="communityLoading" class="spinner-border text-success" role="status">
                                    </div>
                                    <span>
                                        <strong x-text="communities.page.totalElements"></strong> communities available
                                    </span>
                                </div>
                                <div>
                                    <button @click="communityToggle = !communityToggle" x-show="!communityToggle"
                                        class="btn btn-sm btn-success rounded-0" data-toggle="tooltip"
                                        data-original-title="Show new community form;">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button @click="clearCommunityFilter()" class="btn btn-sm btn-dark rounded-0"
                                        data-toggle="tooltip" data-original-title="Clear filter">
                                        <i class="fas fa-brush"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div x-show="communityToggle" class="col-12 mb-2">
                            <div class="input-group input-group-sm">
                                <input x-model="communityModel" type="text" class="form-control"
                                    placeholder="Community name">
                                <div x-show="communityModel" @click="addCommunity()" class="input-group-append">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-save"></i>
                                    </span>
                                </div>
                                <div class="input-group-append">
                                    <span @click="communityToggle = !communityToggle"
                                        class="input-group-text bg-danger text-white" data-toggle="tooltip"
                                        data-original-title="Cancel and hide new community form">
                                        <i class="fas fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="list-container border">
                                <ul class="list-group">
                                    <template x-for="community in communities.elements">
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input @change="onChangeSelectedCommunity(community)" name="community"
                                                    class="form-check-input" type="radio"
                                                    :id="'community_'+ community.id">
                                                <label class="form-check-label" :for="'community_'+community.id"
                                                    x-text="community.name"></label>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    Page <span x-text="(communities.page.number + 1)"></span> - <span
                                        x-text="communities.page.totalPages"></span>
                                </div>
                                <div>
                                    <button class="btn btn-sm rounded-0 btn-dark"
                                        @click="prevCommunitiesPage(communities.page.number)"
                                        x-bind:disabled="toggleEnablePrevButton(communities.page.number,communities.page.totalPages)">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="btn btn-sm rounded-0 btn-dark"
                                        @click="nextCommunitiesPage(communities.page.number)"
                                        x-bind:disabled="toggleEnableNextButton(communities.page.number,communities.page.totalPages)">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="subcommunities">
                <div class="col-12 col-md-6 col-lg-4 my-4">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div x-show="subcommunityLoading" class="spinner-border text-success" role="status">
                                    </div>
                                    <span>
                                        <strong x-text="subcommunities.page.totalElements"></strong> subcommunities
                                        available
                                    </span>
                                </div>
                                <div>
                                    <button @click="subcommunityToggle = !subcommunityToggle"
                                        x-show="!subcommunityToggle" class="btn btn-sm btn-success rounded-0"
                                        data-toggle="tooltip" data-original-title="Show new subcommunity form">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button @click="clearSubcommunityFilter()" class="btn btn-sm btn-dark rounded-0"
                                        data-toggle="tooltip" data-original-title="Clear filter">
                                        <i class="fas fa-brush"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div x-show="subcommunityToggle" class="col-12 mb-2">
                            <div class="input-group input-group-sm">
                                <input x-model="subcommunityModel" type="text" class="form-control"
                                    placeholder="Subcommunity name">
                                <div x-show="subcommunityModel" @click="addSubcommunity()" class="input-group-append">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-save"></i>
                                    </span>
                                </div>
                                <div class="input-group-append">
                                    <span @click="subcommunityToggle = !subcommunityToggle"
                                        class="input-group-text bg-danger text-white" data-toggle="tooltip"
                                        data-original-title="Cancel and hide new subcommunity form">
                                        <i class="fas fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div x-show="subcommunities.page.totalElements > 0" class="col-12 mb-2">
                            <div class="list-container border">
                                <ul class="list-group">
                                    <template x-for="subcommunity in subcommunities.elements">
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input @change="onChangeSelectedSubcommunity(subcommunity)"
                                                    name="subcommunity" class="form-check-input" type="radio"
                                                    :id="'subcommunity_'+ subcommunity.id">
                                                <label class="form-check-label" :for="'subcommunity_'+subcommunity.id"
                                                    x-text="subcommunity.name"></label>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div x-show="subcommunities.page.totalElements > 0" class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    Page <span x-text="(subcommunities.page.number + 1)"></span> - <span
                                        x-text="subcommunities.page.totalPages"></span>
                                </div>
                                <div>
                                    <button class="btn btn-sm rounded-0 btn-dark"
                                        @click="prevSubcommunitiesPage(subcommunities.page.number)"
                                        x-bind:disabled="toggleEnablePrevButton(subcommunities.page.number,subcommunities.page.totalPages)">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="btn btn-sm rounded-0 btn-dark"
                                        @click="nextSubommunitiesPage(subcommunities.page.number)"
                                        x-bind:disabled="toggleEnableNextButton(subcommunities.page.number,subcommunities.page.totalPages)">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template x-if="collections">
                <div class="col-12 col-md-6 col-lg-4 my-4">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div x-show="collectionLoading" class="spinner-border text-success" role="status">
                                    </div>
                                    <span><strong x-text="collections.page.totalElements"></strong> collections
                                        available</span>
                                </div>
                                <button @click="collectionToggle = !collectionToggle" x-show="!collectionToggle"
                                    class="btn btn-sm btn-success rounded-0" data-toggle="tooltip"
                                    data-original-title="Show new collection form">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div x-show="collectionToggle" class="col-12 mb-2">
                            <div class="input-group input-group-sm">
                                <input x-model="collectionModel" type="text" class="form-control"
                                    placeholder="Collection name">
                                <div x-show="collectionModel" @click="addCollection()" class="input-group-append">
                                    <span class="input-group-text bg-primary text-white">
                                        <i class="fas fa-save"></i>
                                    </span>
                                </div>
                                <div class="input-group-append">
                                    <span @click="collectionToggle = !collectionToggle"
                                        class="input-group-text bg-danger text-white" data-toggle="tooltip"
                                        data-original-title="Cancel and hide new collection form">
                                        <i class="fas fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div x-show="collections.page.totalElements > 0" class="col-12 mb-2">
                            <div class="list-container border">
                                <ul class="list-group">
                                    <template x-for="collection in collections.elements">
                                        <li class="list-group-item">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="collection"
                                                    :id="'collection_'+ collection.id" :value="collection.name">
                                                <label class="form-check-label" :for="'collection_'+collection.id"
                                                    x-text="collection.name"></label>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                        <div x-show="collections.page.totalElements > 0" class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <div>
                                    Page <span x-text="(collections.page.number + 1)"></span> - <span
                                        x-text="collections.page.totalPages"></span>
                                </div>
                                <div>
                                    <button class="btn btn-sm rounded-0 btn-dark"
                                        x-bind:disabled="toggleEnablePrevButton(collections.page.number,collections.page.totalPages)">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="btn btn-sm rounded-0 btn-dark"
                                        x-bind:disabled="toggleEnableNextButton(collections.page.number,collections.page.totalPages)">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script defer>
    function data() {
        return {
            useBootstrap: @this.useBootstrap,
            // Communities
            communities: null,
            communitiesFilter: '',
            communityLoading: false,
            communityModel: null,
            communityToggle: false,
            selectedCommunity: null,

            subcommunities: null,
            subcommunityLoading: false,
            subcommunityModel: null,
            subcommunityToggle: null,
            selectedSubcommunity: null,

            collections: null,
            collectionLoading: false,
            collectionModel: null,
            collectionToggle: null,
            selectedCollection: null,

            init: function () {
                this.getCommunities(0);
            },
            // Communities
            async addCommunity() {
                await @this.createCommunity(this.communityModel);
                this.getCommunities(0);
                this.communityModel = null;
                this.communityToggle = false;
            },
            async clearCommunityFilter() {
                this.communityModel = null;
                this.selectedCommunity = null;
                this.subcommunities = null;
                this.collections = null;
                this.getCommunities(0);
                var communitiesRadio = document.getElementsByName("community");
                for (var i = 0; i < communitiesRadio.length; i++) communitiesRadio[i].checked = false;
            },
            async getCommunities(page) {
                this.communityLoading = true;
                this.communities = await @this.getCommunities(page);
                this.communityLoading = false;
            },
            async getCommunitiesByName(){
                this.collections = @this.getCommunitiesByName(0,this.communitiesFilter);
            },
            async nextCommunitiesPage(page) {
                this.communities = await @this.getCommunities((page + 1));
            },
            async onChangeSelectedCommunity(community) {
                if (typeof community !== 'undefined') {
                    this.selectedCommunity = community;
                    await this.getSubcommunities(community.name, 0);
                    await this.getCollections(community.name, 0);
                }
            },
            async prevCommunitiesPage(page) {
                this.communities = await @this.getCommunities((page - 1));
            },

            // Subcommunities
            async addSubcommunity() {
                await @this.createSubcommunity(this.subcommunityModel, this.selectedCommunity.name);
                this.getSubcommunities(this.selectedCommunity.name, 0);
                this.subcommunityModel = null;
                this.subcommunityToggle = false;
            },
            async clearSubcommunityFilter() {
                this.subcommunityModel = null;
                this.selectedSubcommunity = null;
                this.collections = null;
                this.getSubcommunities(this.selectedCommunity.name, 0);
                this.getCollections(this.selectedCommunity.name,0);
                var subcommunitiesRadio = document.getElementsByName("subcommunity");
                for (var i = 0; i < subcommunitiesRadio.length; i++) subcommunitiesRadio[i].checked = false;
            },
            async getSubcommunities(communityName, page) {
                this.subcommunityLoading = true;
                this.subcommunities = await @this.getSubcommunities(communityName, page);
                this.subcommunityLoading = false;
            },
            async nextSubcommunitiesPage(communityParentName, page) {
                this.subcommunities = await @this.getSubcommunities(communityParentName, (page + 1));
            },
            async onChangeSelectedSubcommunity(subcommunity) {
                if (typeof subcommunity !== 'undefined') {
                    this.selectedSubcommunity = subcommunity;
                    await this.getCollections(subcommunity.name, 0);
                }
            },
            async prevSubcommunitiesPage(communityParentName, page) {
                this.subcommunities = await @this.getSubcommunities(communityParentName, (page - 1));
            },

            // Collections
            async addCollection() {
                let communityName = this.getSelectedCommunity();
                if (communityName) {
                    await @this.createCollection(this.collectionModel, communityName);
                    this.getCollections(communityName, 0);
                    this.collectionModel = null;
                    this.collectionToggle = false;
                }
            },
            async getCollections(communityName, page) {
                this.collectionLoading = true;
                this.collections = await @this.getCollections(communityName, page);
                this.collectionLoading = false;
            },
            async nextCollectionsPage(page) {
                this.collections = await @this.getCollections(this.getSelectedCommunity(), (page + 1));
            },
            async onChangeSelectedCollections(collection) {
                if (typeof collection !== 'undefined') {
                    this.selectedCollection = collection;
                    await this.getCollections(this.getSelectedCommunity(), 0);
                }
            },
            async prevCollectionsPage(page) {
                this.collections = await @this.getCollections(this.getSelectedCommunity(), (page - 1));
            },
            getSelectedCommunity() {
                let communityName = null;
                if (this.selectedCommunity && !this.selectedSubcommunity) communityName = this.selectedCommunity.name;
                if (this.selectedCommunity && this.selectedSubcommunity) communityName = this.selectedSubcommunity.name;
                return communityName;
            },



            toggleEnablePrevButton(current, total) {
                if (current == 0) return true;
                return false;
            },
            toggleEnableNextButton(current, total) {
                if ((current + 1) == total) return true;
                return false;
            },
        };
    }
</script>