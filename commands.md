#Commands

php artisan make:model Comments -mcr
-mcr makes controller and migration as well

git add .

Git branches allow you to work on multiple versions of your codebase simultaneously. You can use branches to isolate new features, fix bugs, or experiment with different approaches without affecting the main branch of your repository.

Here are the basic steps for working with branches in GitHub:

Create a new branch: To create a new branch, use the git branch command followed by the name of the new branch. For example:

Copy code
git branch my-new-feature
This will create a new branch called my-new-feature based on the current branch.

Switch to a different branch: To switch to a different branch, use the git checkout command followed by the name of the branch. For example:

Copy code
git checkout my-new-feature
This will switch to the my-new-feature branch.

Make changes and commit them: Once you are on the new branch, you can make changes to the code and commit them as you normally would.

Push the branch to GitHub: To push the branch to GitHub, use the git push command followed by the name of the remote (usually origin) and the name of the branch. For example:

Copy code
git push origin my-new-feature
This will push the my-new-feature branch to GitHub.

Merge the branch into the main branch: Once you are ready to merge your changes into the main branch, you can use the git merge command followed by the name of the branch you want to merge. For example:

Copy code
git checkout main-branch
git merge my-new-feature
This will merge the changes from the my-new-feature branch into the main-branch.

I hope this helps! Let me know if you have any questions.
