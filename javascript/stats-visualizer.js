document.addEventListener('DOMContentLoaded', function() {
  // Fetch stats data
  fetchStatsData();
});

function fetchStatsData() {
  fetch('get_teacher_syllabi.php')
      .then(response => {
          if (!response.ok) {
              throw new Error('Network response was not ok');
          }
          return response.json();
      })
      .then(data => {
          if (data.success) {
              visualizeStats(data.data.stats);
          } else {
              console.error('Error fetching stats:', data.error);
              // Show sample visualization if API fails
              visualizeSampleStats();
          }
      })
      .catch(error => {
          console.error('Error fetching stats data:', error);
          visualizeSampleStats();
      });
}

function visualizeStats(stats) {
  const total = stats.active + stats.revisions; // Total of all statuses
  if (total === 0) return; // Don't visualize if no data
  
  // Create container if it doesn't exist
  let container = document.getElementById('stats-visualization');
  if (!container) {
      container = document.createElement('div');
      container.id = 'stats-visualization';
      container.className = 'mt-4';
      document.querySelector('.lg\\:col-span-2').appendChild(container);
  }
  
  container.innerHTML = `
      <h3 class="text-sm font-medium text-gray-700 mb-2">Submission Progress</h3>
      <div class="flex items-center">
          <div class="flex-1 h-4 bg-gray-200 rounded-full overflow-hidden">
              <div class="h-full flex">
                  <div class="bg-green-500" style="width: ${(stats.approved / total) * 100}%"></div>
                  <div class="bg-yellow-500" style="width: ${(stats.pending / total) * 100}%"></div>
                  <div class="bg-red-500" style="width: ${(stats.revisions / total) * 100}%"></div>
              </div>
          </div>
          <div class="ml-3 text-xs text-gray-500">
              ${stats.approved + stats.pending + stats.revisions} total
          </div>
      </div>
      <div class="flex justify-between mt-2 text-xs text-gray-600">
          <div class="flex items-center">
              <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-1"></span>
              Approved (${stats.approved})
          </div>
          <div class="flex items-center">
              <span class="inline-block w-2 h-2 rounded-full bg-yellow-500 mr-1"></span>
              Pending (${stats.pending})
          </div>
          <div class="flex items-center">
              <span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-1"></span>
              Revisions (${stats.revisions})
          </div>
      </div>
  `;
}

function visualizeSampleStats() {
  const sampleStats = {
      approved: 8,
      pending: 2,
      revisions: 1
  };
  visualizeStats(sampleStats);
}