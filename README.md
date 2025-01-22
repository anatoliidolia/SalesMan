# SalesMan Class

## Description
The `SalesMan` class is a simple implementation for finding the optimal district that minimizes the maximum distance to specified types of buildings. This is useful for scenarios where you need to determine the best location in a grid-like structure for accessibility purposes.

The class uses a pre-defined 2D associative array (`$graphs`) to represent districts and the availability of different types of buildings (e.g., hospital, school, restaurant, gym) in each district. The class calculates the optimal district based on the shortest maximum distance to these building types.

---

## Features
- Allows you to modify the `$graphs` array to represent custom scenarios.
- Calculates the optimal district by minimizing the maximum distance to all building types.
- Provides execution time and memory usage for performance insights.

---

## Installation
1. Ensure you have PHP 8.2 or higher installed on your machine.
2. Copy the `SalesMan` class code into a PHP file, e.g., `salesman.php`.

---

## How to Run
1. Open a terminal or command prompt.
2. Navigate to the directory containing the `salesman.php` file.
3. Execute the file using the following command:
   ```bash
   php salesman.php
   ```

---

## Example Output
When executed with the default `$graphs` configuration, the script will produce an output similar to this:

```
Optimal district: 4
Execution time: 0.0001
Memory usage: 0.22
```

### Explanation of the Output
- **Optimal district:** This indicates the index of the district that minimizes the maximum distance to all building types.
- **Execution time:** The time (in seconds) it took to execute the script.
- **Memory usage:** The memory (in kilobytes) used during the script's execution.

---

## Customization
You can modify the `$graphs` array inside the `__construct` method to represent your own set of districts and building availability. The structure of the `$graphs` array is as follows:

```php
$this->graphs = [
    0 => [
        'hospital' => 0,
        'school' => 0,
        'restaurant' => 0,
        'gym' => 0,
    ],
    1 => [
        'hospital' => 0,
        'school' => 1,
        'restaurant' => 0,
        'gym' => 0,
    ],
    // Add more districts as needed
];
```

### Notes:
- Each district is represented as an associative array.
- Keys are building types (e.g., 'hospital', 'school').
- Values are `1` (building present) or `0` (building absent).

