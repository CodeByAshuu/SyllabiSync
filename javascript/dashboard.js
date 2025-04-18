document.addEventListener('DOMContentLoaded', function() {
    // Initialize sidebar toggle functionality
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebarCollapseBtn = document.querySelector('.sidebar-collapse-btn');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');

    // Toggle sidebar on mobile
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        sidebarOverlay.classList.toggle('active');
        document.body.classList.toggle('overflow-hidden');
    });

    // Collapse sidebar on desktop
    if (sidebarCollapseBtn) {
        sidebarCollapseBtn.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-expanded');
        });
    }

    // Close sidebar when clicking overlay
    sidebarOverlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
        document.body.classList.remove('overflow-hidden');
    });

    // Fetch teacher data with loading animation
    setTimeout(() => {
        fetchTeacherData();
    }, 500); // Small delay to show loading animation
});

function fetchTeacherData() {
    // Show loading state
    document.getElementById('recent-syllabi-container').innerHTML = `
        <div class="syllabus-item border-b pb-3 animate-pulse">
            <div class="flex justify-between items-center">
                <div class="space-y-2">
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                </div>
                <div class="h-6 bg-gray-200 rounded-full w-16"></div>
            </div>
        </div>
        <div class="syllabus-item border-b pb-3 animate-pulse">
            <div class="flex justify-between items-center">
                <div class="space-y-2">
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                </div>
                <div class="h-6 bg-gray-200 rounded-full w-16"></div>
            </div>
        </div>
        <div class="syllabus-item border-b pb-3 animate-pulse">
            <div class="flex justify-between items-center">
                <div class="space-y-2">
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-3 bg-gray-200 rounded w-1/2"></div>
                </div>
                <div class="h-6 bg-gray-200 rounded-full w-16"></div>
            </div>
        </div>
    `;

    fetch('get_teacher_syllabi.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                updateDashboard(data.data);
            } else {
                console.error('Error fetching data:', data.error);
                showSampleData();
            }
        })
        .catch(error => {
            console.error('Error fetching teacher data:', error);
            showSampleData();
        });
}

function updateDashboard(data) {
    // Update stats cards with animation
    animateValue('active-courses', 0, data.stats.active, 1000);
    animateValue('pending-approvals', 0, data.stats.pending, 1000);
    animateValue('approved-syllabi', 0, data.stats.approved, 1000);
    animateValue('revisions-needed', 0, data.stats.revisions, 1000);
    document.getElementById('active-change').textContent = data.stats.active_change;
    document.getElementById('approved-change').textContent = data.stats.approved_change;

    // Update recent syllabi
    updateRecentSyllabi(data.syllabi);
}

function animateValue(id, start, end, duration) {
    const obj = document.getElementById(id);
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

function updateRecentSyllabi(syllabi) {
    const container = document.getElementById('recent-syllabi-container');
    container.innerHTML = '';

    // Filter and sort syllabi
    const filteredSyllabi = syllabi
        .filter(syllabus => syllabus.teacher_id === '1234567' || syllabus.teacher_id === '12324754') // Filter by teacher ID
        .sort((a, b) => new Date(b.lastUpdated) - new Date(a.lastUpdated))
        .slice(0, 5);

    if (filteredSyllabi.length === 0) {
        container.innerHTML = `
            <div class="text-center py-4 text-gray-500">
                <i class="fas fa-book-open text-3xl mb-2 text-gray-300"></i>
                <p>No syllabi found</p>
            </div>
        `;
        return;
    }

    filteredSyllabi.forEach((syllabus, index) => {
        const statusClass = getStatusClass(syllabus.status);
        const statusText = getStatusText(syllabus.status);
        const formattedTitle = formatTitle(syllabus.title);

        const syllabusItem = document.createElement('div');
        syllabusItem.className = `syllabus-item border-b pb-3 animate-fadeInUp`;
        syllabusItem.style.animationDelay = `${0.1 * index}s`;
        syllabusItem.innerHTML = `
            <div class="flex justify-between items-center">
                <div class="truncate pr-2">
                    <h3 class="font-medium text-sm md:text-base truncate">${formattedTitle}</h3>
                    <p class="text-xs text-gray-500 truncate">${syllabus.code || 'No Code'} - Last updated: ${formatDate(syllabus.lastUpdated)}</p>
                </div>
                <span class="px-3 py-1 ${statusClass} rounded-full text-xs whitespace-nowrap">${statusText}</span>
            </div>
        `;
        container.appendChild(syllabusItem);
    });
}

function showSampleData() {
    const sampleData = {
        stats: {
            active: 5,
            pending: 2,
            approved: 8,
            revisions: 1,
            active_change: 2,
            approved_change: 3
        },
        syllabi: [
            {
                title: "Computer Science 101",
                code: "CS101",
                status: "approved",
                lastUpdated: "2023-05-15",
                teacher_id: "1234567"
            },
            {
                title: "Data Structures",
                code: "CS201",
                status: "pending",
                lastUpdated: "2023-05-20",
                teacher_id: "1234567"
            },
            {
                title: "Algorithms",
                code: "CS301",
                status: "rejected",
                lastUpdated: "2023-05-10",
                teacher_id: "12324754"
            }
        ]
    };
    updateDashboard(sampleData);
}

// Helper functions
function getStatusClass(status) {
    switch(status) {
        case 'approved': return 'bg-green-100 text-green-800';
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'rejected': return 'bg-red-100 text-red-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function getStatusText(status) {
    switch(status) {
        case 'approved': return 'Approved';
        case 'pending': return 'Pending';
        case 'rejected': return 'Revisions';
        default: return status;
    }
}

function formatTitle(title) {
    if (!title) return 'Untitled Syllabus';
    // Remove the random prefix and _Syllabus.pdf suffix
    return title.replace(/^\d+_/, '').replace(/_Syllabus\.pdf$/, '').replace(/_/g, ' ');
}

function formatDate(dateString) {
    if (!dateString) return 'Unknown date';
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
}
// Load stats visualizer
const statsScript = document.createElement('script');
statsScript.src = 'javascript/stats-visualizer.js';
document.body.appendChild(statsScript);