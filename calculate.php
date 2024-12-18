<?php
        function calculateLifeExpectancy($gender, $country) {
            $lifeExpectancy = [
                'male' => [
                    'usa' => 76,
                    'uk' => 79,
                    'canada' => 80,
                    'australia' => 81,
                    'india' => 69,
                    'other' => 72
                ],
                'female' => [
                    'usa' => 81,
                    'uk' => 83,
                    'canada' => 84,
                    'australia' => 85,
                    'india' => 73,
                    'other' => 76
                ],
                'other' => [
                    'usa' => 79,
                    'uk' => 81,
                    'canada' => 82,
                    'australia' => 83,
                    'india' => 71,
                    'other' => 74
                ]
            ];

            return $lifeExpectancy[$gender][$country] ?? 75;
        }

        function generateLifeInsights($years, $gender, $occupation) {
            $insights = [
                "Based on your age and occupation, you've gained " . ($years * 365 * 24) . " hours of life experience!",
                "Your unique journey as a " . $occupation . " has shaped your perspective in countless ways.",
                "You've potentially made " . ($years * 12) . " months of memories and life choices.",
                "As a " . ($gender == 'male' ? 'man' : ($gender == 'female' ? 'woman' : 'individual')) . ", you've navigated life's challenges with resilience."
            ];
            return $insights[array_rand($insights)];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $dob = htmlspecialchars($_POST['dob']);
            $gender = htmlspecialchars($_POST['gender']);
            $country = htmlspecialchars($_POST['country']);
            $occupation = htmlspecialchars($_POST['occupation']);

            $dobDate = new DateTime($dob);
            $currentDate = new DateTime();
            $age = $currentDate->diff($dobDate);

            $years = $age->y;
            $months = $age->m;
            $days = $age->d;

            $lifeExpectancy = calculateLifeExpectancy($gender, $country);
            $remainingYears = max(0, $lifeExpectancy - $years);
            echo "<!DOCTYPE html>";
            echo "<html lang='en'>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<head>";
            echo "<title>Life Insights</title>";
            echo "<link rel='stylesheet' href='styles.css'>";
            echo "</head>";
            echo "<body>";

            echo "<div class='result'>";
            echo "<h2>Hello, $name! 👋</h2>";
            echo "<p>🕰️ Your Life Journey:</p>";
            echo "<p>$years years, $months months, $days days</p>";
            
            echo "<p>🌍 Life Expectancy Insights:</p>";
            echo "<p>Estimated Life Expectancy: $lifeExpectancy years</p>";
            echo "<p>Estimated Remaining Years: $remainingYears years</p>";
            
            echo "<p>💡 Personal Insight: " . generateLifeInsights($years, $gender, $occupation) . "</p>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
        ?>