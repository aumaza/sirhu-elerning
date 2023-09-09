#!/bin/bash

echo "# sirhu-elearning" >> README.md
echo "Plataforma de capacitación online" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/aumaza/sirhu-elerning.git
git push -u origin main