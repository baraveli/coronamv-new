Vue.component("graphline", {
  props: ["title", "value"],
  data: function () {
    ctx: null;
  },
  computed: {
    data: function () {

      return {
        labels: this.title,
        datasets: [{
          backgroundColor: sparklineGradient,
          borderColor: "#FFFFFF",
          data: this.value
        }]
      };

    }
  },

  template: `
      <div class="br2">
          <canvas class="card-color-white" style="padding-top:8px; border-radius:5px;"></canvas>
      </div>
    `,


  created: function () {
    link = "/api/v1/open/global/daily"

    fetch(link, {
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      }
    }).then((data) => {
      return (data.json())

    }).then((json_data) => {
      cases = []
      recovered = []
      time = []
      for (entry of json_data["data"]) {
        total_sum = entry["totalConfirmed"]
        total_recovered = entry["totalRecovered"]
        reported_time = entry["reportDate"]
        //add the values to array
        if (total_sum != null) {
          cases.push(total_sum)
          recovered.push(total_recovered)
          time.push(new Date(reported_time).toLocaleDateString("en-US").split("/").join("-")) //change / to -
        }

      }
      //console.log(cases, time)
      var historicalData = {
        cases_sum: cases,
        recovered_sum: recovered,
        time: time
      }
      return (historicalData)
    }).then((data) => {
      this.ctx = this.$el.querySelector("canvas").getContext("2d");
      let sparklineGradient = this.ctx.createLinearGradient(0, 0, 0, 135);
      sparklineGradient.addColorStop(0, "rgba(51,51,51,0.35)");
      sparklineGradient.addColorStop(1, "rgba(51,51,51,0.5)");

      var data = {
        labels: data.time,
        datasets: [{
            label: "Cases",
            fill: true,
            backgroundColor: "rgba(255, 150, 0, 0.2)",
            borderColor: "#FFAC00",
            pointBackgroundColor: "#FF9600",
            pointRadius: 3,
            pointHoverRadius: 5,
            borderWidth: 1,
            data: data.cases_sum

          }
          /*  {
             label: "Recovered",
             fill: true,
             backgroundColor: "rgba(0, 206, 147, 0.2)",
             borderColor: "#00EBA2",
             pointBackgroundColor: "#00CE93",
             pointRadius: 3,
             pointHoverRadius: 5,
             borderWidth: 1,
             data: data.recovered_sum
           } */
        ]
      };


      Chart.Line(this.ctx, {
        data: data,
        options: {

          scales: {
            xAxes: [{
              type: 'time',
                time: {
                    unit: 'month'
                },
              display: true
            }],

            yAxes: [{
              display: true
            }]
          }
        }
      });
    })
  }

});



Vue.component("island-card", {
  props: ["island"],
  template: `
    <div class="br2">
      <div class="pa3 flex-auto bb b--white-10">
        <h3 class="mt0 mb1 f6 ttu white o-80">{{ island.name }}</h3>
        <h2 class="mv0 f2 fw5 white">{{ island.confirmed }}</h2>
      </div>
    </div>
  `
});






Vue.component("status-card", {
  props: ["text", "value", "colour"],

  template: `
  
  <div class="w-50 relative flex flex-column" style="margin-top:0px;">
  <div class="pa3 flex-auto">
    <hr class="o-60" />
    <h3 class="mt0 mb1 f6 ttu o-90" style="color:#3A3A56;">{{ text }}</h3>
    <h2 class="mv0 mt-2 f2 fw5" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700;" :class="colour">{{ Number(value).toLocaleString() }}</h2>
    <hr class="o-60" />   
  </div>

</div>`,
})



new Vue({
  el: "#dashboard",
  data: {
    updated_at: "",
    maldives: [],
    infectionData: [],
    tests: [],
    maldivestotal: [],

    perPage: 10,
    currentPage: 1,
    pageOptions: [5, 10, 15, 20],
    keyword: '',
    dataArray: [],
    fields: [{
        key: 'total_death',
        label: 'މަރުގެ އަދަދު',
        sortable: true,
        formatter: value => {
          return Number(value).toLocaleString();
        }
      },
      {
        key: 'total_recovered',
        label: 'ރަނގަޅުވެފައިވާ ޢަދަދު',
        sortable: true,
        formatter: value => {
          return Number(value).toLocaleString();
        }
      },
      {
        key: 'total_cases',
        label: 'ފެނިފައިވާ އަދަދު',
        sortable: true,
        formatter: value => {
          return Number(value).toLocaleString();
        }
      },
      {
        key: 'country_name',
        label: 'ޤައުމު',
        sortable: true,
        formatter: value => {
          return value.charAt(0).toUpperCase() + value.slice(1);
        }
      }
    ],


    //map
    atoll: "", //current selected atoll
    confirmed: "", // total confirmed for the selected atoll
    recovered: "", // total recovered for the selected atoll
    active: "",
    case_data: null, // parsedJson["data"]["cases"] of the json from api
    atoll_islands: [], //islands of selected atoll thiese are objectcts returned from api (will confirmed,recovered) for each island
    atoll_totals: {}, //totals of atolls added to a object for speed
    positive_fill: "#AB1219",
    default_fill: "#FDC4AE"

  },

  methods: {

    getCountryTotal: function () {
      fetch('/api/v1/open/countries/total', {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        .then((response) => {
          return response.json()
        })
        .then((parsedJson) => {
          this.dataArray = parsedJson["data"];
        })
    },

    getGlobalTotal: function () {
      fetch('/api/v1/open/global', {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        .then((response) => {
          return response.json()
        })
        .then((parsedJson) => {
          this.infectionData = parsedJson["data"]
        })
    },

    getMaldivesData: function () {
      fetch('/api/v1/open/maldives', {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          }
        })
        .then((response) => {
          return response.json()
        })
        .then((parsedJson) => {
          this.maldives = parsedJson["data"];
          this.tests = parsedJson["data"]["tests"]
          this.maldivestotal = parsedJson["data"]["totals"]
          this.case_data = parsedJson["data"]["cases"]

          //use the case_data to calculate atoll_counts(confirmed,recovered)
          this.atollTotals(this.case_data)

          return this.case_data
        }).then((case_data) => {
          //change fill by no of cases 
          let paths = this.$el.querySelectorAll('path')
          //for each atoll(path of svg)
          paths.forEach(el => {
            let atoll = el.id //id of path is atoll name 
            //console.log(this.atoll_totals)
            let confirmed = this.getCases(atoll) //gets the cases for the atoll
            if (confirmed > 0) {
              el.setAttribute('fill', this.pSBC(0.19 * Math.log(confirmed), this.default_fill, this.positive_fill, true)) //
            }
          })
        });
    },

    pSBC: (p, c0, c1, l) => {
      let r, g, b, P, f, t, h, i = parseInt,
        m = Math.round,
        a = typeof (c1) == "string";
      if (typeof (p) != "number" || p < -1 || p > 1 || typeof (c0) != "string" || (c0[0] != 'r' && c0[0] != '#') || (c1 && !a)) return null;
      if (!this.pSBCr) this.pSBCr = (d) => {
        let n = d.length,
          x = {};
        if (n > 9) {
          [r, g, b, a] = d = d.split(","), n = d.length;
          if (n < 3 || n > 4) return null;
          x.r = i(r[3] == "a" ? r.slice(5) : r.slice(4)), x.g = i(g), x.b = i(b), x.a = a ? parseFloat(a) : -1
        } else {
          if (n == 8 || n == 6 || n < 4) return null;
          if (n < 6) d = "#" + d[1] + d[1] + d[2] + d[2] + d[3] + d[3] + (n > 4 ? d[4] + d[4] : "");
          d = i(d.slice(1), 16);
          if (n == 9 || n == 5) x.r = d >> 24 & 255, x.g = d >> 16 & 255, x.b = d >> 8 & 255, x.a = m((d & 255) / 0.255) / 1000;
          else x.r = d >> 16, x.g = d >> 8 & 255, x.b = d & 255, x.a = -1
        }
        return x
      };
      h = c0.length > 9, h = a ? c1.length > 9 ? true : c1 == "c" ? !h : false : h, f = this.pSBCr(c0), P = p < 0, t = c1 && c1 != "c" ? this.pSBCr(c1) : P ? {
        r: 0,
        g: 0,
        b: 0,
        a: -1
      } : {
        r: 255,
        g: 255,
        b: 255,
        a: -1
      }, p = P ? p * -1 : p, P = 1 - p;
      if (!f || !t) return null;
      if (l) r = m(P * f.r + p * t.r), g = m(P * f.g + p * t.g), b = m(P * f.b + p * t.b);
      else r = m((P * f.r ** 2 + p * t.r ** 2) ** 0.5), g = m((P * f.g ** 2 + p * t.g ** 2) ** 0.5), b = m((P * f.b ** 2 + p * t.b ** 2) ** 0.5);
      a = f.a, t = t.a, f = a >= 0 || t >= 0, a = f ? a < 0 ? t : t < 0 ? a : a * P + t * p : 0;
      if (h) return "rgb" + (f ? "a(" : "(") + r + "," + g + "," + b + (f ? "," + m(a * 1000) / 1000 : "") + ")";
      else return "#" + (4294967296 + r * 16777216 + g * 65536 + b * 256 + (f ? m(a * 255) : 0)).toString(16).slice(1, f ? undefined : -2)
    },

    //gets the cases for the selected atoll
    //simple object lookup
    getCases(atoll) {
      confirmed = 0
      if (this.atoll_totals.hasOwnProperty(atoll)) {
        confirmed = this.atoll_totals[atoll]["total_confirmed"]
      }
      return confirmed
    },

    //sets the cases for the atoll so the vue data updates
    setCases(atoll) {
      this.confirmed = 0
      this.recovered = 0
      console.log(atoll);
      console.log(this.atoll_totals)
      if (this.atoll_totals[atoll] != undefined) {
        this.confirmed = this.atoll_totals[atoll]["total_confirmed"]
        this.recovered = this.atoll_totals[atoll]["total_recovered"]
        this.active = this.atoll_totals[atoll]["total_active"]
      }
    },

    //function for calculation total islands from api data which contains island seperate
    atollTotals(case_data) {
      //store atoll totals in atoll totals
      for (island of case_data) {
        let atoll = island["administrative_atoll"]


        //if already has atoll property add to previos array if not create
        if (this.atoll_totals.hasOwnProperty(atoll)) {
          this.atoll_totals[atoll] = {
            "total_confirmed": this.atoll_totals[atoll]["total_confirmed"] + island["confirmed"],
            "total_recovered": this.atoll_totals[atoll]["total_recovered"] + island["recovered"],
            "total_active": this.atoll_totals[atoll]["total_active"] + island["active"],

          }


        } else {
          this.atoll_totals[atoll] = {
            "total_confirmed": island["confirmed"],
            "total_recovered": island["recovered"],
            "total_active": island["active"],
          }
        }

      }
    },

    addClickHandler() {
      let paths = this.$el.querySelectorAll('path')
      paths.forEach(el => {
        //the atoll name is id for each path
        let atoll = el.id
        el.addEventListener('mouseover', () => {

          this.atoll = atoll
          this.setCases(atoll) //updates the confirmed and recovered for atoll  in vue data
          this.atoll_islands = []
          if (this.confirmed > 0) {
            // list islands


            //loops through all islands to get islands of the selected atoll
            //adds to atoll_islands so can be accesssed in html
            this.case_data.forEach((island) => {
              if (island["administrative_atoll"].toLowerCase() == atoll.toLowerCase()) {
                this.atoll_islands.push(island)
              }

            })
            console.log(this.atoll_islands)


          }
        })

      })
    }


  },

  computed: {

    // calculating record states
    entries: function () {
      return `Showing ${(this.perPage * this.currentPage) - this.perPage + 1} to ${(this.perPage * this.currentPage)} of ${this.rows} entries`;
    },

    items: function () {
      return this.keyword ?
        this.dataArray.filter(item => item.country_name.toLowerCase().trim().includes(this.keyword.toLowerCase())) :
        this.dataArray
    },
    rows: function () {
      return this.items.length
    }

  },

  filters: {

    /* dateDifforhumans: function (date) {
      return moment(date).fromNow();
    } */


  },

  mounted: function () {
    this.getCountryTotal();
    this.addClickHandler();
  },

  created: function () {
    Chart.defaults.global.legend.display = false;
    this.getGlobalTotal();
    this.getMaldivesData();
  },

});


new Vue({
  el: "#live",
  data: {
    feeds: []
  },

  created() {
    fetch('/api/v1/open/global/feeds', {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
      .then((response) => {
        return response.json()
      })
      .then((parsedJson) => {
        rawdata = parsedJson["data"];
        this.feeds = rawdata.slice(0, 10)

      })

  }
});

new Vue({
  el: "#mvnews",
  data: {
    feeds: []
  },

  created() {
    fetch('https://api.coronamv.live/v1/open/feeds/mv', {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      })
      .then((response) => {
        return response.json()
      })
      .then((parsedJson) => {
        this.feeds = parsedJson["data"];
      })

  }
});
