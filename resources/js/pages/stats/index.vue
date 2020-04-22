<template>
  <div class="row">
    <div class="col-md-3">
      <card :title="$t('stats')" class="settings-card">
        <ul class="nav flex-column nav-pills">
          <li v-for="tab in tabs" :key="tab.route" class="nav-item">
            <router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
              <fa :icon="tab.icon" fixed-width />
              {{ tab.name }}
            </router-link>
          </li>
        </ul>
      </card>
    </div>

    <div class="col-md-9">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  computed: {
    tabs () {
      return [
        {
          icon: 'poll',
          name: this.$t('total'),
          route: 'stats.total'
        },

        {
          icon: 'file-medical',
          name: this.$t('test'),
          route: 'stats.test'
        },

        {
          icon: 'biohazard',
          name: this.$t('risk'),
          route: 'stats.risk'
        },

        {
          icon: 'flag',
          name: this.$t('maldives'),
          route: 'stats.maldives'
        }
      ]
    }
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
</style>
