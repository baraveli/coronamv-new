function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  //{ path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },

  //{ path: '/register', name: 'register', component: page('auth/register.vue') },

  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/users', name: 'users.index', component: page('users/index.vue') },

  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') },
      { path: 'newusers', name: 'settings.newusers', component: page('settings/newuser.vue') }
    ] },

    { path: '/stats',
  component: page('stats/index.vue'),
  children: [
    { path: '', redirect: { name: 'stats.total' } },
    { path: 'total', name: 'stats.total', component: page('stats/Total.vue') },
    { path: 'test', name: 'stats.test', component: page('stats/Test.vue') },
    { path: 'risk', name: 'stats.risk', component: page('stats/Risk.vue') },
    { path: 'maldives', name: 'stats.maldives', component: page('stats/Maldives.vue') }
  ] },


    
  { path: '/resources',
  component: page('resources/index.vue'),
  children: [
    { path: '', redirect: { name: 'resources.resourcefilter' } },
    { path: 'resourcefilter', name: 'resources.resourcefilter', component: page('resources/ResourceFilter.vue') },
    { path: 'resources', name: 'resources.resources', component: page('resources/Resources.vue') }
  ] },

  { path: '*', component: page('errors/404.vue') }
]
