const DEBUG = true;
const STORAGE_KEY = 'submitMetricsParams';

const reachGoal = (goal, metric_name = 'ya') => {

    if (!goal) {
        console.error('Goal is required');
        return;
    }

    switch (metric_name) {
        case 'ya':
            const metric = window.yaCounter42617899 || {};
            metric.reachGoal(goal);
            if (DEBUG) {
                console.log(`Reach goal. Metric: ${metric_name}. Goal: ${goal}`)
            }
            break;
        default:
            console.error(`Metric ${metric_name} not found`);
            break;
    }
};

(($) => {

    $('[data-target="#order-speaker"], [data-target="#order"]').on('click', function (e) {
        const $target = $(e.target);
        const goal = $target.data('submit-goal');
        const metric = $target.data('submit-metric');
        if (goal) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify({
                goal,
                metric
            }));
        } else {
            localStorage.removeItem(STORAGE_KEY)
        }
    });

})(window.jQuery);
