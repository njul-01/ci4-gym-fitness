</div> <!-- End layout-container -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Filter buttons functionality
document.querySelectorAll('.btn-filter').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-filter').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Trigger filter action
        const filterType = this.textContent.trim();
        filterClasses(filterType);
    });
});

// Pagination functionality
document.querySelectorAll('.pagination-btn:not(:disabled)').forEach(btn => {
    btn.addEventListener('click', function() {
        if (!this.querySelector('i')) {
            document.querySelectorAll('.pagination-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        }
    });
});

function filterClasses(type) {
    const classItems = document.querySelectorAll('.class-item');
    
    classItems.forEach(item => {
        const statusBadge = item.querySelector('.status-badge');
        if (!statusBadge) return;
        
        if (type === 'All') {
            item.style.display = 'flex';
        } else {
            const statusText = statusBadge.textContent.trim();
            item.style.display = statusText === type ? 'flex' : 'none';
        }
    });
}
</script>

</body>
</html>