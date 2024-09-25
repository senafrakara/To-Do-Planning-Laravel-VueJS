<template>
    <div class="uk-container">
      <div v-if="loading" class="uk-text-center">
        <div uk-spinner></div>
        <p>Loading...</p>
      </div>
      <div v-else>
        <h2 class="uk-heading-line uk-text-center">
          <span>Total Weeks Needed To Complete All Tasks = {{ totalWeeksNeeded }}</span>
        </h2>
  
        <div uk-grid>
          <div v-for="(developers, week) in distribution" :key="week" class="uk-width-1-3">
            <div class="uk-card uk-card-default uk-card-body">
              <h3 class="uk-card-title">Week {{ week }}</h3>
              <ul class="uk-list uk-list-divider">
                <li v-for="(tasks, developer) in developers" :key="developer">
                  <h4 class="uk-text-bold">{{ developer }}</h4>
                  <h5 class="uk-heading-bullet">Tasks</h5>
                  <ul class="uk-list uk-list-bullet">
                    <li v-for="task in tasks" :key="task.id">
                      {{ task.name }} (Duration: {{ task.duration }} h, Level: {{ task.level }})
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  
  <script>
  export default {
    data() {
      return {
        distribution: {}, 
        loading: true,    
        totalWeeksNeeded: 0
      };
    },
    mounted() {
      this.fetchDistribution();
    },
    methods: {
      async fetchDistribution() {
        try {
          const response = await fetch('tasks/plan-distribute-tasks'); 
          if (!response.ok) {
            throw new Error('Server response Error');
          }
          const data = await response.json();
          console.log(data);
          this.distribution = data.taskDistribution;
          this.totalWeeksNeeded = data.totalWeeksNeeded;
        } catch (error) {
          console.error('Error:', error);
        } finally {
          this.loading = false; 
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .uk-container {
    max-width: 1000px;
    margin: 0 auto;
  }
  
  .uk-heading-line {
    margin-top: 10px;
  }
  
  .uk-card {
    padding: 15px;
    background-color: #f9f9f9;
  }
  
  .uk-card-title {
    color: #333;
    text-decoration-line: underline;
  }
  
  .uk-list-divider > li {
    padding: 5px;
  }
  
  .uk-list-bullet {
    padding-left: 15px;
  }
  
  .uk-spinner {
    margin-top: 10px;
  }
  
  .uk-text-center {
    margin-top: 15px;
  }
  
  h2, h3, h4, h5 {
    margin-bottom: 5px;
  }
  </style>
  