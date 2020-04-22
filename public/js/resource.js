new Vue({
    el: "#app",
    data: {
        filter_set: [],
        resources: [],
        resourcesraw: []
    },

    methods: {
        filter: function (key) {
            if (key == 'all') {
                this.resources = this.resourcesraw;
            } else {
                this.resources = this.resourcesraw.filter(item => item.resource_tag.toLowerCase()
                    .trim().includes(key))

            }
        },


        GetResources: function () {
            fetch('/api/v1/open/resources', )
                .then((response) => {
                    return response.json()
                })
                .then((parsedJson) => {
                    this.resourcesraw = parsedJson["data"]["resources"];
                    this.resources = parsedJson["data"]["resources"];
                    this.filter_set = parsedJson["data"]["filters"]

                })
        }
    },

    created() {
        this.GetResources();

    }
});