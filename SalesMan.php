<?php
declare(strict_types=1);

class SalesMan
{
    private const MAX_VALUE = 1024;
    
    private const MIN_VALUE = -1;

    /**
     * @var array|int[][]
     */
    private array $graphs;

    /**
     * Construct
     */
    public function __construct()
    {
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
            2 => [
                'hospital' => 1,
                'school' => 0,
                'restaurant' => 0,
                'gym' => 0,
            ],
            5 => [
                'hospital' => 1,
                'school' => 1,
                'restaurant' => 1,
                'gym' => 0,
            ],
            3 => [
                'hospital' => 0,
                'school' => 0,
                'restaurant' => 0,
                'gym' => 0,
            ],
            4 => [
                'hospital' => 0,
                'school' => 0,
                'restaurant' => 0,
                'gym' => 1,
            ],
        ];
    }

    /**
     * Validate and return final result
     *
     * @return string
     */
    public function execute(): string
    {
        $optimalValue = $this->findOptimalDistrict();

        if ($optimalValue >= 0) {
            return "Optimal district: $optimalValue";
        }

        return "We can't find the optimal value";
    }

    /**
     * Find and return the lowest distance to each type of building
     *
     * @return int
     */
    public function findOptimalDistrict(): int
    {
        $distances = $this->calculateDistance();

        // Find the district with the lowest max distance
        $bestDistrict = self::MIN_VALUE;
        $minMaxDistance = self::MAX_VALUE;

        foreach ($distances as $district => $distanceData) {
            $maxDistance = max($distanceData);

            if ($maxDistance < $minMaxDistance) {
                $minMaxDistance = $maxDistance;
                $bestDistrict = $district;
            }
        }

        return $bestDistrict;
    }

    /**
     * Calculate distance
     *
     * @return array
     */
    private function calculateDistance(): array
    {
        $distances = [];

        $buildingTypes = array_keys($this->graphs[0]);
        $arrayCount = count($this->graphs);

        foreach ($buildingTypes as $building) {
            $lastSeen = self::MIN_VALUE;

            // from left to right
            for ($i = 0; $i < $arrayCount; $i++) {
                if ($this->graphs[$i][$building]) {
                    $lastSeen = $i;
                }

                $distances[$i][$building] = $lastSeen !== self::MIN_VALUE ? $i - $lastSeen : self::MAX_VALUE + 1;
            }

            // from right to left
            $lastSeen = self::MIN_VALUE;
            for ($i = $arrayCount - 1; $i >= 0; $i--) {
                if ($this->graphs[$i][$building]) {
                    $lastSeen = $i;
                }

                if ($lastSeen !== self::MIN_VALUE) {
                    $distances[$i][$building] = min($distances[$i][$building], $lastSeen - $i);
                }
            }
        }

        return $distances;
    }
}

$startMemory = memory_get_usage();
$startTime = microtime(true);

$salesMan = new SalesMan();
echo $salesMan->execute(). PHP_EOL;

$endTime = microtime(true);
$endMemory = memory_get_usage();

$executionTime = $endTime - $startTime;
$memoryUsed = $endMemory - $startMemory;

echo "Execution time: " . number_format($executionTime, 6) . PHP_EOL;
echo "Memory usage: " . number_format($memoryUsed / 1024, 2) . PHP_EOL;
